<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

class Debugger {
    // -1 for no debugging
    const LOG_VERBOSE_LVL = 0;
    // Verbose levels
    const INFO = 0;
    const WATCH = 1;
    const ERROR = 2;

    public static function LogString($verbose_level, $callerFunc, $log_data) {
        if ($verbose_level >= Debugger::LOG_VERBOSE_LVL)
            echo "<script> console.log('[" .$callerFunc. "] " .$log_data. "');</script>";
    }
}   

// Singleton instance
$Debugger = new Debugger;
?>