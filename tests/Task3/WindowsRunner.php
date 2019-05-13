<?php

namespace Tests\Task3;

class WindowsRunner implements ServerRunner
{
    public function start(string $host, int $port, string $root)
    {
        return proc_open("php -S $host:$port -t $root >nul 2>&1", [], $pipes);
    }

    public function stop($handle)
    {
        $pid = proc_get_status($handle)['pid'];
        exec("taskkill /PID $pid /F /T");
        proc_close($handle);
    }
}
