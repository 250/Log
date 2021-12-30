<?php
declare(strict_types=1);

use ScriptFUSION\Steam250\Log\ProgressProcessor;
use PHPUnit\Framework\TestCase;

/**
 * @see ProgressProcessor
 */
final class ProgressProcessorTest extends TestCase
{
    /**
     * @dataProvider provideCounts
     */
    public function test(int $count, int $total, int $pct): void
    {
        $record = (new ProgressProcessor)([
            'message' => 'foo',
            'context' => [
                'count' => $count,
                'total' => $total,
            ],
        ]);

        self::assertStringContainsString("$count/$total ($pct%)", $record['message']);
    }

    public function provideCounts(): iterable
    {
        return [
            [0, 1, 0],
            [0, 2, 0],
            [1, 1, 100],
            [2, 2, 100],
            [5, 10, 50],
            [1, 2, 50],
            [1, 4, 25],
            [1, 3, 33],
        ];
    }
}
