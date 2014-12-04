<?php

namespace BetterError;

class Exception 
{
    public $message;
    /** @var Trace[] */
    public $traces = [];
    public $className;
    public $fileName;
    public $source;
    public $next;

    public function __construct(\Exception $e)
    {
        $this->message = $e->getMessage();
        $this->className = get_class($e);
        $this->source = $this->displaySource($e);
        $this->fileName = $e->getFile();

        foreach ($e->getTrace() as $trace) {
            $traceObj = new Trace($trace);
            $this->traces[] = $traceObj;
        }

        $prev = $e->getPrevious();
        if (!is_null($prev)) {
            $this->next = new Exception($prev);
        }
    }

    private function displaySource(\Exception $e)
    {
        $source = '';
        $file = new \SplFileObject($e->getFile());
        $lineNum = $e->getLine() - 4;
        if ($lineNum < 1) {
            $lineNum = 1;
        }

        $file->seek($lineNum);
        for ($l = 0; $l < 8; $l++) {
            if ($file->eof()) {
                break;
            }

            $source .= $file->current();
            $file->next();
        }

        return $source;
    }
} 