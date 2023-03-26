<?php

declare(strict_types=1);

namespace App;

use App\Actions\CalculateActionInterface;
use App\Actions\DivideAction;
use App\Actions\MinusAction;
use App\Actions\MultiplyAction;
use App\Actions\SumAction;
use App\ArgumentParser\ArgumentParser;
use App\Exceptions\ActionException;
use App\Exceptions\AppException;
use App\FileParser\CsvParser;
use App\DataRepository\DataRepositoryInterface;
use App\Logger\LoggerInterface;

class App
{
    public function __construct(
        private readonly ArgumentParser $argumentParser,
        private readonly DataRepositoryInterface $repository,
        private readonly LoggerInterface $logger,
    ) {
    }

    /**
     * @throws AppException
     */
    public function run(): void
    {
        /* @var $action CalculateActionInterface */
        $action = match ($this->argumentParser->getAction()) {
            ActionEnum::PLUS => new SumAction(),
            ActionEnum::MINUS => new MinusAction(),
            ActionEnum::MULTIPLY => new MultiplyAction(),
            ActionEnum::DIVISION => new DivideAction(),
            default => throw new AppException('Unsupported action'),
        };


        $fileLoader = match ($this->argumentParser->getFileExtension()) {
            FileExtensionEnum::CSV => new CsvParser(),
            default => throw new AppException('Unsupported file format'),
        };

        $this->logger->log("Started {$this->argumentParser->getAction()->value} action");

        foreach ($fileLoader->parse($this->argumentParser->getFile()) as $row) {
            try {
                $result = $action->calculate($row->getNumberOne(), $row->getNumberTwo());
                $row->setResult($result);

                $this->repository->save([$row->getNumberOne(), $row->getNumberTwo(), $row->getResult()]);
            } catch (ActionException $actionException) {
                $this->logger->log($actionException->getMessage());
            }
        }

        $this->logger->log("Finished {$this->argumentParser->getAction()->value} action");
    }
}
