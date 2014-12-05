<?php

namespace BetterError;


class BetterError
{
    /**
     * register handlers
     */
    public static function register()
    {
        set_error_handler(['\BetterError\BetterError', 'errorHandler']);
        set_exception_handler(['\BetterError\BetterError', 'exceptionHandler']);
    }

    /**
     * handler for PHP Error
     * @param $severity
     * @param $message
     * @param $errFile
     * @param $lineNo
     * @param $errContext
     */
    public static function errorHandler($severity, $message, $errFile, $lineNo, $errContext)
    {
        $message = self::errorType($severity) . "\n" . $message;
        $err = new \ErrorException($message, 0, $severity, $errFile, $lineNo);
        echo self::dump($err);
    }

    /**
     * Handler for uncaught Exception
     * @param \Exception $ex
     */
    public static function exceptionHandler(\Exception $ex)
    {
        echo self::dump($ex);
    }

    /**
     * dump formatted Exception
     * @param \Exception $e
     * @return string
     */
    public static function dump(\Exception $e)
    {
        $myException = new Exception($e);
        if (php_sapi_name() == 'cli') {
            return self::printCli($myException);
        }

        return self::printHtml($myException);
    }

    /**
     * dump Html
     * @param Exception $myException
     * @param string $template
     * @return string
     */
    public static function printHtml(Exception $myException, $template = 'bootstrap')
    {
        ob_start();
        require $template . '.phtml';

        return ob_get_clean();
    }

    /**
     * dump string for CLI
     * @param Exception $e
     * @return string
     */
    private static function printCli(Exception $e)
    {
        $cliOutput = '';
        $cliOutput .= BashColor::red . $e->message . BashColor::reset . "\n";
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