<?php

declare(strict_types=1);

namespace App\Logger;

use App\Exceptions\LoggerException;

class FileLogger implements LoggerInterface
{
    protected mixed $file = null;

    /** @throws LoggerException */
    public function __construct(private readonly string $filePath)
    {
        if (!file_exists($this->filePath)) {
            if (!fopen($this->filePath, 'w')) {
                throw new LoggerException('Cannot create log file');
            }
        }

        if (!is_writable($this->filePath)) {
            throw new LoggerException("Unable to write to file");
        }
    }

    /** @throws LoggerException */
    public function log(string $message): void
    {
        if (!is_resource($this->file)) {
            $this->openFile();
        }

        fwrite($this->file, $message . PHP_EOL);

        $this->closeFile();
    }

    /** @throws LoggerException */
    protected function openFile(): void
    {
        if (!$this->file = fopen($this->filePath, 'a')) {
            throw new LoggerException('Cannot open log file');
        }
    }

    protected function closeFile(): void
    {
        fclose($this->file);
    }
}
