<?php

declare(strict_types=1);

namespace App\ArgumentParser;

use App\ActionEnum;
use App\Exceptions\ArgumentParserException;
use App\FileExtensionEnum;

class ArgumentParser
{
    private string $shortOptions = 'a:f:';

    private array $longOptions = [
        'action:',
        'file:',
    ];

    private ?string $action;
    private ?string $file;

    /**
     * @throws ArgumentParserException
     */
    public function __construct()
    {
        $options = getopt($this->shortOptions, $this->longOptions);

        $this->action = $options['action'] ?? null;
        $this->file = $options['file'] ?? null;

        $this->checkAction();
        $this->checkFile();
    }

    /**
     * @throws ArgumentParserException
     */
    private function checkAction(): void
    {
        if (empty($this->action)) {
            throw new ArgumentParserException('Action option is not provided');
        }

        if (!in_array($this->getAction(), ActionEnum::cases())) {
            throw new ArgumentParserException(
                'Action option has incorrect value. Possible values: ' . implode(
                    ', ',
                    array_column(ActionEnum::cases(), 'value')
                )
            );
        }
    }

    /**
     * @throws ArgumentParserException
     */
    private function checkFile(): void
    {
        if (empty($this->file)) {
            throw new ArgumentParserException('File option is not provided');
        }

        if (!in_array($this->getFileExtension(), FileExtensionEnum::cases())) {
            throw new ArgumentParserException(
                'File has unsupported extensions. Supported extensions: ' . implode(
                    ', ',
                    array_column(FileExtensionEnum::cases(), 'value')
                )
            );
        }
    }

    public function getAction(): ?ActionEnum
    {
        return ActionEnum::tryFrom($this->action);
    }

    public function getFileExtension(): ?FileExtensionEnum
    {
        $extension = pathinfo($this->file)['extension'] ?? '';

        return FileExtensionEnum::tryFrom($extension);
    }

    public function getFile(): ?string
    {
        return $this->file;
    }
}
