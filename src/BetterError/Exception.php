<?php

namespace BetterError;

class Exception 
{
    public $message;
    public $traces = [];
    public $className;
    public $next;

    public function __construct(\Exception $e)
    {
        $this->message = $e->getMessage();
        $this->className = get_class($e);

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