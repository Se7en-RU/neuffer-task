<?php

declare(strict_types=1);

namespace Unit\Actions;

use App\Actions\CalculateActionInterface;
use App\Actions\MultiplyAction;
use App\Exceptions\ActionException;
use PHPUnit\Framework\TestCase;

class MultiplyActionUnitTest extends TestCase
{
    private CalculateActionInterface $action;

    protected function setUp(): void
    {
        $this->action = new MultiplyAction();
    }

    /** @test */
    public function calculateTestSuccess(): void
    {
        $testData = [
            [
                'result' => 4,
                'numbers' => [2, 2],
            ],
            [
                'result' => 100,
                'numbers' => [20, 5],
            ],
            [
                'result' => 2,
                'numbers' => [2, 1],
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

        $this->action->calculate(55, 0);
    }
}
