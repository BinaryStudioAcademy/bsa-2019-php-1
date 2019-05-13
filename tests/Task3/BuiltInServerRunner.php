<?php

namespace Tests\Task3;

class BuiltInServerRunner
{
    const HOST = 'localhost';
    const PORT = 1234;
    const TEST_ENDPOINT = 'http://localhost:1234';
    const DOCUMENT_ROOT = __DIR__ . '/../../src/Task3/';

    private $runner;
    private $process;

    public function __construct()
    {
        $this->runner = $this->isRunningOnWindows()
            ? new WindowsRunner()
            : new DefaultRunner();
    }

    private function isRunningOnWindows(): bool
    {
        return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
    }

    public function start()
    {
        $this->process = $this->runner->start(
            self::HOST,
            self::PORT,
            realpath(self::DOCUMENT_ROOT)
        );

        sleep(1);
    }

    public function stop()
    {
        if ($this->process) {
            $this->runner->stop($this->process);
            $this->process = null;
        }
    }
}
