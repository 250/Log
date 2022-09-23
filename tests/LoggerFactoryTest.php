<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use ScriptFUSION\Steam250\Log\LoggerFactory;

/**
 * @see LoggerFactory
 */
final class LoggerFactoryTest extends TestCase
{
    /**
     * Tests that LoggerFactory creates a Logger whose typical output matches the expected format.
     */
    public function test(): void
    {
        (new LoggerFactory())->create('Alfa', false)->info($info = 'Beta');

        $this->expectOutputRegex("[^\[\d{4}-\d\d-\d\d \d\d:\d\d:\d\d\] info: $info$]");
    }
}
