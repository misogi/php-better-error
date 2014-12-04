<?php

namespace BetterError;


class BetterError
{
    public static function register()
    {
        set_error_handler(['\BetterError\BetterError', 'errorHandler']);
        set_exception_handler(['\BetterError\BetterError', 'exceptionHandler']);
    }

    public static function errorHandler($severity, $message, $errFile, $lineNo, $errContext)
    {
        $message = self::errorType($severity) . "\n" . $message;
        $err = new \ErrorException($message, 0, $severity, $errFile, $lineNo);
        echo self::pp($err);
    }

    public static function exceptionHandler(\Exception $ex)
    {
        echo self::pp($ex);
    }

    public static function pp(\Exception $e)
    {
        $myException = new Exception($e);
        if (php_sapi_name() == 'cli') {
            return self::printCli($myException);
        }

        ob_start();
        require 'bootstrap.phtml';

        return ob_get_clean();
    }

    /**
     * @param Exception $e
     * @return string
     */
    private static function printCli(Exception $e)
    {
        $cliOutput = '';
        $cliOutput .= BashColor::Red . $e->message . BashColor::Reset . "\n";
        foreach($e->traces as $trace) {
            $cliOutput .= $trace->cliString();
        }

        return $cliOutput;
    }

    private static function errorType($type)
    {
        switch ($type) {
            case E_ERROR: // 1 //
                return 'Error';
            case E_WARNING: // 2 //
                return 'Warning';
            case E_PARSE: // 4 //
                return 'Parse Error';
            case E_NOTICE: // 8 //
                return 'Notice';
            default:
                return 'Other Error';
        }
    }
}