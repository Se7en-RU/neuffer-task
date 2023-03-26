<?php

declare(strict_types=1);

namespace App\Actions;

use App\Exceptions\ActionException;
use DivisionByZeroError;

final class DivideAction implements CalculateActionInterface
{
    /** @throws ActionException */
    public function calculate(int $a, int $b): float|int
    {
        try {
            $result = $a / $b;
        } catch (DivisionByZeroError) {
            throw new ActionException("Numbers $a and $b are wrong: division by zero");
        }

        if ($result < 0) {
            throw new ActionException("Numbers $a and $b are wrong");
        }

        return $result;
    }
}
