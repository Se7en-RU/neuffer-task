<?php

declare(strict_types=1);

namespace App\FileParser;

use App\Exceptions\FileParserException;
use App\FileRowDto;

class CsvParser implements FileParserInterface
{
    /** @throws FileParserException */
    public function parse(string $file): array
    {
        if (!file_exists($file)) {
            throw new FileParserException('Cannot read file ' . $file);
        }

        $data = [];

        foreach (array_map('str_getcsv', file($file)) as $row) {
            $row = array_map('intval', str_getcsv($row[0], ';'));

            $dto = new FileRowDto();
            $dto->setNumberOne($row[0]);
            $dto->setNumberTwo($row[1]);

            $data[] = $dto;
        }

        return $data;
    }
}
