<?php

declare(strict_types=1);

namespace Unit\Actions;

use App\Actions\CalculateActionInterface;
use App\Actions\DivideAction;
use App\Exceptions\ActionException;
use PHPUnit\Framework\TestCase;

class DivideActionUnitTest extends TestCase
{
    private CalculateActionInterface $action;

    protected function setUp(): void
    {
        $this->action = new DivideAction();
    }

    /** @test */
    public function calculateTestSuccess(): void
    {
        $testData = [
            [
                'result' => 10,
                'numbers' => [10, 1],
            ],
            [
                'result' => 2,
                'numbers' => [10, 5],
            ],
            [
                'result' => 3.3333333333333335,
                'numbers' => [10, 3],
            ],
        ];

        foreach ($testData as $data) {
            $actionResult = $this->action->calculate($data['numbers'][0], $data['numbers'][1]);

            $this->assertEquals($actionResult, $data['result']);
        }
    }

    /** @test */
    public function calculateTestFailDivisionByZero()
    {
        $this->expectException(ActionException::class);

        $this->action->calculate(10, 0);
    }

    /** @test */
    public function calculateTestFailLessThanZero()
    {
        $this->expectException(ActionException::class);

        $this->action->calculate(-2, 2);
    }
}
