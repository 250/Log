<?php
declare(strict_types=1);

namespace ScriptFUSION\Steam250\Log;

use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;

final class ProgressProcessor implements ProcessorInterface
{
    public function __invoke(LogRecord $record): LogRecord
    {
        $count = $record['context']['count'] ?? null;
        $total = $record['context']['total'] ?? null;

        if (isset($count, $total)) {
            $percent = (int)($count / $total * 100);

            return $record->with(message: "$count/$total ($percent%) $record[message]");
        }

        return $record;
    }
}
