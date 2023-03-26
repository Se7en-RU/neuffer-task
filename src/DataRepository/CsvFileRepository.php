<?php

declare(strict_types=1);

namespace App\DataRepository;

use App\Exceptions\RepositoryException;

class CsvFileRepository implements DataRepositoryInterface
{
    protected mixed $file = null;

    /** @throws RepositoryException */
    public function __construct(private readonly string $filePath)
    {
        if (!file_exists($this->filePath)) {
            if (!fopen($this->filePath, 'w')) {
                throw new RepositoryException('Cannot create file');
            }
        }

        if (!is_writable($this->filePath)) {
            throw new RepositoryException("Unable to write to file");
        }
    }

    /** @throws RepositoryException */
    public function save(array $data): void
    {
        if (!is_resource($this->file)) {
            $this->openFile();
        }

        $data = implode(';', $data);
        fwrite($this->file, $data . PHP_EOL);

        $this->closeFile();
    }


    /** @throws RepositoryException */
    protected function openFile(): void
    {
        if (!$this->file = fopen($this->filePath, 'a')) {
            throw new RepositoryException('Cannot open file');
        }
    }

    protected function closeFile(): void
    {
        fclose($this->file);
    }
}
