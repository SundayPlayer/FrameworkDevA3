<?php

namespace FrameworkDevA3\Log;

class Log
{
    private function __construct()
    {
    }

    public static function log()
    {
        $time = date("D, d M Y H:i:s");
        $time = "[" . $time . "] <br>";
        $file = __DIR__."/fichier.log";

        $fileLog = fopen($file, "a+");
        fwrite($fileLog, $time);

        foreach (debug_backtrace() as $temp) {
            $event = "File : " . $temp['file'] . " | Line : " . $temp['line'] . " | Function : " . $temp['function'] . "<br><br>";
            fwrite($fileLog, $event);
        }
        fclose($fileLog);
    }
}
