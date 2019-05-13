<?php

namespace Tests\Task3;

interface ServerRunner
{
    public function start(string $host, int $port, string $root);
    public function stop($handle);
}
