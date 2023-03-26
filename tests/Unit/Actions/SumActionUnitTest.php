<?php

declare(strict_types=1);

namespace Unit\Actions;

use App\Actions\CalculateActionInterface;
use App\Actions\MinusAction;
use App\Actions\SumAction;
use App\Exceptions\ActionException;
use PHPUnit\Framework\TestCase;

class SumActionUnitTest extends TestCase
{
    private CalculateActionInterface $action;

    protected function setUp(): void
    {
        $this->action = new SumAction();
    }

    /** @test */
    public function calculateTestSuccess(): void
    {
        $testData = [
            [
                'result' => 10,
                'numbers' => [10, 0],
            ],
            [
                'result' => 20,
                'numbers' => [10, 10],
            ],
            [
                'result' => 1,
                'numbers' => [10, -9],
            ],
        ];

        foreach ($testData as $data) {
            $actionResult = $this->action->calculate($data['numbers'][0], $data['numbers'][1]);

            $this->assertEquals($actionResult, $data['result']);
        }
    }

    /** @test */
    public function calculateTestFailLessThanZero()
    {
        $this->expectException(ActionException::class);

        $this->action->calculate(-10, 0);
    }
}
