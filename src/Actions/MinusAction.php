<?php

declare(strict_types=1);

namespace App\Actions;

use App\Exceptions\ActionException;

final class MinusAction implements CalculateActionInterface
{
    /** @throws ActionException */
    public function calculate(int $a, int $b): float|int
    {
        $result = $a - $b;

        if ($result < 0) {
            throw new ActionException("Numbers $a and $b are wrong");
        }

        return $result;
    }
}
