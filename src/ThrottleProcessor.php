<?php
declare(strict_types=1);

namespace ScriptFUSION\Steam250\Log;

use ScriptFUSION\Async\Throttle\DualThrottle;
use ScriptFUSION\Async\Throttle\Throttle;

final class ThrottleProcessor
{
    public function __invoke(array $record): array
    {
        $throttle = $record['context']['throttle'] ?? null;

        if ($throttle instanceof Throttle) {
            $record['message'] .= " AR: {$throttle->countAwaiting()}";

            if ($throttle instanceof DualThrottle) {
                $record['message'] .= " {$throttle->measureThroughput()}/s";
            }
        }

        return $record;
    }
}
