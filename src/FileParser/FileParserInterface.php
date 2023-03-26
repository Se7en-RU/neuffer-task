<?php

namespace App\FileParser;

use App\FileRowDto;

interface FileParserInterface
{
    /** @return FileRowDto[] */
    public function parse(string $file): array;
}
