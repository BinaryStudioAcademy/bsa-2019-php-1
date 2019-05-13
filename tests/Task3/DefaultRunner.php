<?php

namespace Tests\Task3;

class DefaultRunner implements ServerRunner
{
    public function start(string $host, int $port, string $root)
    {
        exec("php -S $host:$port -t $root >/dev/null 2>&1 & echo $!", $result);

        return $result[0];
    }

    public function stop($handle)
    {
        exec("kill -9 $handle");
    }
}
