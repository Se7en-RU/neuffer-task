<?php

namespace App\Actions;

use App\Exceptions\ActionException;

interface CalculateActionInterface
{
    /** @throws ActionException */
    public function calculate(int $a, int $b): float|int;
}
