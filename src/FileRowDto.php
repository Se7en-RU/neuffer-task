<?php

declare(strict_types=1);

namespace App;

class FileRowDto
{
    public int $numberOne;
    public int $numberTwo;

    public int|float $result;

    public function getNumberOne(): int
    {
        return $this->numberOne;
    }

    public function setNumberOne(int $numberOne): void
    {
        $this->numberOne = $numberOne;
    }

    public function getNumberTwo(): int
    {
        return $this->numberTwo;
    }

    public function getResult(): int|float
    {
        return $this->result;
    }

    public function setNumberTwo(int $numberTwo): void
    {
        $this->numberTwo = $numberTwo;
    }

    public function setResult(int|float $result): void
    {
        $this->result = $result;
    }
}
