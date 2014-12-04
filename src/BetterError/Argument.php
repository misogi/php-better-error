<?php

namespace BetterError;

class Argument
{
    /** @var  string */
    public $type;

    public $value;

    public function __construct($arg)
    {
        if (is_object($arg)) {
            $this->type = get_class($arg);
        } elseif (is_array($arg)) {
            $this->type = 'array';
        } elseif (is_string($arg)) {
            $this->type = 'string';
        } elseif (is_float($arg)) {
            $this->type = 'float';
        } elseif (is_int($arg)) {
            $this->type = 'int';
        } elseif (is_bool($arg)) {
            $this->type = 'bool';
        }

        $this->value = $arg;
    }
}
