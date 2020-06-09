<?php

namespace Core;

class Error
{
    /**
     * Error Handler - Convert all errors to Exception using the errorException
     * 
     * @param int $level - Error Level
     * @param string $message - Error Message
     * @param string $file - Filename that the error occured
     * @param int $line - Line Number where error occured
     * 
     * @return void
     */
    public static function errorhandler($level, $message, $file, $line)
    {
        if (error_reporting() !== 0) {
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    /**
     * Exception Handler
     * 
     * @param Exception $exception - The exception
     * 
     * @return void
     */
    public static function exceptionHandler($exception)
    {
        if (\Config\Error::SHOW_ERRORS) {
            echo "<h2>Fetal error</h2>";
            echo "<p>Uncaught Exception: '" . get_class($exception) . "'</p>";
            echo "<p>Message: <pre>'" . $exception->getMessage() . "'</pre></p>";
            echo "<p>Stack Trace: '" . $exception->getTraceAsString() . "'</p>";
            echo "<p>Throw in '" . $exception->getFile() . "' on line " . $exception->getLine() . " </p>";
        } else {
            $log = dirname(__DIR__) . '/logs/' . date('Y-m-d') . '.txt';
            ini_set('error_log', $log);

            $message = "Uncaught exception: '" . get_class($exception) . "' ";
            $message .= "with message: <pre>'" . $exception->getMessage() . "' ";
            $message .= "\nStack Trace: '" . $exception->getTraceAsString() . "'";
            $message .= "\nThrow in '" . $exception->getFile() . "' on line " . $exception->getLine();

            error_log($message);

            // Error Code 404 for page not found, 500 for server errors
            $code = $exception->getCode();

            // if ($code == 404) {
            //     echo "<h1>Page Not Found.</h1>";
            // } else if ($code >= 500 && $code <= 505) {
            //     echo "<h1>A Server Error has occured.</h1>";
            // } else {
            //     echo "<h1>An Error has occured </h1>";
            // }
            View::renderTemplate("Errors/$code.php");
        }
    }
}
