<?php
declare(strict_types=1);

namespace ScriptFUSION\Steam250\Log;

use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;

final class SteamAppProcessor implements ProcessorInterface
{
    public function __invoke(LogRecord $record): LogRecord
    {
        $app = $record['context']['app'] ?? null;

        if ($app) {
            return $record->with(message: str_replace('%app%', "#$app[id] $app[name]", $record['message']));
        }

        return $record;
    }
}
