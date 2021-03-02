<?php
/**
 * The logger class, that will log every every information about the cream enviroment
 * all the logs will be keeped separated
 */
class CreamLogger {
    /**
     * Logs the information in the log
     * @param ELoggerLevel $level The level of the log (in what log to save)
     * @param string $data The data to be stored
     * @param string $caller The caller function (nullable)
     */
    static function Log($level, $data, $caller = null) {
        switch ($level) {
            case ELoggerLevel::INFO:
                $handle = fopen(__DIR__ . "/../../logs/info.log", "a+");
                if ($caller == null)
                    $str = "[" .date("Y-m-d h:i:sa"). "] ". $data . "\n";
                else
                    $str = "[" .date("Y-m-d h:i:sa"). "] [". $caller ."] ". $data . "\n";
                break;
            case ELoggerLevel::WARNING:
                $handle = fopen(__DIR__ . "/../../logs/warning.log", "a+");
                if ($caller == null)
                    $str = "[" .date("Y-m-d h:i:sa"). "] [WARNING] ". $data . "\n";
                else
                    $str = "[" .date("Y-m-d h:i:sa"). "] [". $caller . " WARNING!!] ". $data . "\n";
                break;
            case ELoggerLevel::ERROR:
                $handle = fopen(__DIR__ . "/../../logs/error.log", "a+");
                if ($caller == null)
                    $str = "[" .date("Y-m-d h:i:sa"). "] [ERROR!!] ". $data . "\n";
                else
                    $str = "[" .date("Y-m-d h:i:sa"). "] [". $caller . " ERROR!!] ". $data . "\n";
                break;
            // Do not write to log if the enum is not set up correctly
            default: return;
        }

        fwrite($handle, $str);
        fclose($handle);
        return;
    }
}

abstract class ELoggerLevel {
    const INFO = 0;
    const WARNING = 1;
    const ERROR = 2;
}