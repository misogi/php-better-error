<?php

namespace BetterError;

class Argument
{
    /** @var  string */
    public $type;
    /** @var  */
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

    /**
     * @return string
     */
    public function printArg()
    {
        if (is_object($this->value)) {
            if (method_exists($this->value, '__toString')) {
                // if object implement __toString()
                return get_class($this->value) . ":{$this->value}";
            }

            return get_class($this->value);
        }

        if ($this->type === 'array') {
            return $this->printArray($this->value);
        }

        return "{$this->value}";
    }

    private function printArray(array $arr)
    {
        $printValues = [];
        foreach ($arr as $val) {
            if (is_object($val)) {
                $printVal = get_class($val);
            } elseif (is_array($val)) {
                $printVal = '[]';
            } elseif (is_null($val)) {
                $printVal = 'null';
            } else {
                $printVal = $val;
            }

            $printValues[] = $printVal;
        }

        return join(', ', $printValues);
    }
}
