<?php

namespace BetterError;

class Exception 
{
    public $message;
    public $traces = [];
    public $next;

    public function __construct(\Exception $e)
    {
        $this->message = $e->getMessage();

        foreach ($e->getTrace() as $trace) {
            $traceObj = new Trace($trace);
            $this->traces[] = $traceObj;
        }

        $prev = $e->getPrevious();
        if (!is_null($prev)) {
            $this->next = new Exception($prev);
        }
    }
} 