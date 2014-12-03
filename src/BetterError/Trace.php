<?php

namespace BetterError;

class Trace 
{
    /** @var  int  */
    public $line;
    /** @var  string */
    public $file;
    /** @var  string */
    public $function;
    /** @var  string */
    public $type;
    /** @var  string */
    public $class;

    public function __construct(array $t)
    {
        $properties = ['file', 'line', 'function', 'type', 'class'];

        foreach ($properties as $property) {
            if (!empty($t[$property])) {
                $this->$property = $t[$property];
            }
        }
    }

    public function getMethod()
    {
        return "{$this->class}{$this->type}{$this->function}()";
    }
} 