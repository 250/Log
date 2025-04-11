<?php
declare(strict_types=1);

use Monolog\Level;
use Monolog\LogRecord;
use PHPUnit\Framework\TestCase;
use ScriptFUSION\Async\Throttle\DualThrottle;
use ScriptFUSION\Steam250\Log\ThrottleProcessor;

/**
 * @see ThrottleProcessor
 */
final class ThrottleProcessorTest extends TestCase
{
    public function test(): void
    {
        $record = (new ThrottleProcessor)(new LogRecord(
            new DateTimeImmutable(),
            'Alfa',
            Level::Info,
            $message = 'Bravo',
            [
                'throttle' => new DualThrottle(),
            ],
        ));

        self::assertSame("$message AR: 0 0/s", $record['message']);
    }
}
