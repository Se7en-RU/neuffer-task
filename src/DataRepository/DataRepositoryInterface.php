<?php

namespace App\DataRepository;

interface DataRepositoryInterface
{
    public function save(array $data): void;
}
