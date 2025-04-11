<?php
declare(strict_types=1);

namespace ScriptFUSION\Steam250\Log;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

final class LoggerFactory
{
    public const FORMAT = "[%datetime%] %extra.level_name%: %message%\n";
    public const DATE_FORMAT = 'Y-m-d H:i:s';

    public function create(string $name, bool $verbose): LoggerInterface
    {
        return new Logger(
            $name,
            [
                (new StreamHandler('php://output', $verbose ? Level::Debug : Level::Info))
                    ->setFormatter(new LineFormatter(self::FORMAT, self::DATE_FORMAT)),
            ],
            [
                new ShortLevelNameProcessor,
                new ProgressProcessor,
                new SteamAppProcessor,
                new ThrottleProcessor,
            ]
        );
    }
}
