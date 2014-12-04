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
        } else {
            $this->type = gettype($arg);
        }

        $this->value = $arg;
    }

    /**
     * @return string
     */
    public function printArg()
    {
        if ($this->type === 'array') {
            return $this->printArray($this->value);
        }

        return $this->printValue($this->value);
    }

    private function printArray(array $arr)
    {
        $printValues = [];
        foreach ($arr as $val) {
            $printValues[] = $this->printValue($val);
        }

        return '[' . join(', ', $printValues) . ']';
    }

    /**
     * @param $val
     * @return string
     */
    private function printValue($val)
    {
        if (is_object($val)) {
            $printVal = get_class($val);
        } elseif (is_array($val)) {
            $printVal = '[]';
        } elseif(is_string($val)) {
            return '"' . $val . '"';
        } elseif (is_null($val)) {
            $printVal = 'null';
        } elseif (is_bool($val)) {
            $printVal = $val ? 'true' : 'false';
        } else {
            $printVal = "$val";
        }

        return $printVal;
    }
}
