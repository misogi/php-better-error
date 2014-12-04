<?php

namespace BetterError;


class BetterError
{
    public static function register()
    {
        set_error_handler(['\BetterError\BetterError', 'errorHandler']);
    }

    public static function errorHandler($severity, $message, $errFile, $lineNo, $errContext)
    {
        $message = self::errorType($severity) . "\n" . $message;
        $err = new \ErrorException($message, 0, $severity, $errFile, $lineNo);
        echo self::pp($err);
    }

    public static function pp(\Exception $e)
    {
        if (php_sapi_name() == 'cli') {
            return self::printCli($e);
        }

        $traces = [];
        foreach($e->getTrace() as $trace) {
            $traceObj = new Trace($trace);
            $traces[] = $traceObj;
        }

        ob_start();
        require 'html.phtml';

        return ob_get_clean();
    }

    /**
     * @param \Exception $e
     * @return string
     */
    private static function printCli(\Exception $e)
    {
        $cliOutput = '';
        $cliOutput .= BashColor::Red . $e->getMessage() . BashColor::Reset . "\n";
        foreach($e->getTrace() as $trace) {
            $traceObj = new Trace($trace);
            $cliOutput .= $traceObj->cliString();
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