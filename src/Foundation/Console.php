<?php

namespace heinthanth\bare\Foundation;

class Console
{
    public static function Execute(string $command)
    {
        while (@ob_end_flush()) {
        };
        $proc = popen($command, 'r');
        while (!feof($proc)) {
            echo fread($proc, 4096);
            @flush();
        }
    }
}
