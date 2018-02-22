<?php

namespace FrameworkDevA3\Log;

class Log
{
    private static $file = "../LogFiles/fichier.log";


    private function __construct()
    {
    }

    public static function log()
    {
        $time = date("D, d M Y H:i:s");
        $time = "[" . $time . "] \n";

        $fileLog = fopen(self::$file, "a+");
        fwrite($fileLog, $time);

        foreach (debug_backtrace() as $temp) {
            $event = "File : " . $temp['file'] . " | Line : "
                . $temp['line'] . " | Function : " . $temp['function'] ."\n\n";
            fwrite($fileLog, $event);
        }
        fclose($fileLog);
    }

    public static function addLog($message, $line, $file)
    {
        $time = date("D, d M Y H:i:s");
        $time = "[" . $time . "] \n";

        $fileLog = fopen(self::$file, "a+");
        fwrite($fileLog, $time);
        $event = "Message : " . $message . " | File : " . $file . " | Line : "
            . $line . "\n\n";

        fwrite($fileLog, $event);
        fclose($fileLog);
    }
}
