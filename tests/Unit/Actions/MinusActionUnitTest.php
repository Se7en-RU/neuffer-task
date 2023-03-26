<?php

declare(strict_types=1);

namespace Unit\Actions;

use App\Actions\CalculateActionInterface;
use App\Actions\MinusAction;
use App\Exceptions\ActionException;
use PHPUnit\Framework\TestCase;

class MinusActionUnitTest extends TestCase
{
    private CalculateActionInterface $action;

    protected function setUp(): void
    {
        $this->action = new MinusAction();
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
                'result' => 5,
                'numbers' => [10, 5],
            ],
            [
                'result' => 12,
                'numbers' => [10, -2],
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

        $this->action->calculate(-2, 0);
    }
}
