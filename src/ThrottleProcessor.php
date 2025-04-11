<?php
declare(strict_types=1);

namespace ScriptFUSION\Steam250\Log;

use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;
use ScriptFUSION\Async\Throttle\DualThrottle;
use ScriptFUSION\Async\Throttle\Throttle;

final class ThrottleProcessor implements ProcessorInterface
{
    public function __invoke(LogRecord $record): LogRecord
    {
        $throttle = $record['context']['throttle'] ?? null;

        if ($throttle instanceof Throttle) {
            $message = "AR: {$throttle->countPending()}";

            if ($throttle instanceof DualThrottle) {
                $message .= " {$throttle->measureThroughput()}/s";
            }
        }

        return isset($message) ? $record->with(message: "$record->message $message") : $record;
    }
}
