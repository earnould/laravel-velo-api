<?php

if (!function_exists('ddl')) {
    function ddl($var, ...$moreVars)
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1);
        if (php_sapi_name() == 'cli') {
            print_r("\e[1;30m dumped at: " . str_replace(base_path(), '', $trace[0]['file']). ", line: " . $trace[0]['line'] . "\e[40m\n");
        } else {
            print_r("[dumped at: " . str_replace(base_path(), '', $trace[0]['file']). ", line: " . $trace[0]['line'] . "]\n");
        }
        return dd($var, ...$moreVars);
    }
}