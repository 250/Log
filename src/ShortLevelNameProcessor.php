<?php
declare(strict_types=1);

namespace ScriptFUSION\Steam250\Log;

use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;

/**
 * Translates all log levels into exactly four characters.
 */
final class ShortLevelNameProcessor implements ProcessorInterface
{
    private const LEVELS = [
        'DEBUG'     => 'dbug',
        'INFO'      => 'info',
        'NOTICE'    => 'note',
        'WARNING'   => 'Warn',
        'ERROR'     => 'EROR',
        'CRITICAL'  => 'CRIT',
        'ALERT'     => 'ALRT',
        'EMERGENCY' => 'EMRG',
    ];

    public function __invoke(LogRecord $record): LogRecord
    {
        $record->extra['level_name'] = self::LEVELS[$record['level_name']];

        return $record;
    }
}
