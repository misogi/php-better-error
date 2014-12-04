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
    /** @var Argument[] */
    public $args = [];


    public function __construct(array $t)
    {
        $properties = ['file', 'line', 'function', 'type', 'class'];

        foreach ($properties as $property) {
            if (!empty($t[$property])) {
                $this->$property = $t[$property];
            }
        }

        foreach ($t['args'] as $arg) {
            $this->args[] = new Argument($arg);
        }
    }

    public function strippedFile()
    {
        $fileName = $this->file;

        $fileName = str_replace('phar://', '', $fileName);
        $pwd = getcwd();
        $fileName = str_replace($pwd, '', $fileName);

        return $fileName;
    }

    public function getMethod()
    {
        return "{$this->class}{$this->type}{$this->function}({$this->printArgs()})";
    }

    public function cliString()
    {
        $color = '';
        if (strpos($this->class, 'PHPUnit_') !== false) {
            $color = BashColor::LightGray;
        }

        if (empty($this->file) && empty($this->line)) {
            $file = '';
        } else {
            $file = $this->strippedFile() . ":{$this->line} ";
        }

        $cliString = $color . $file . $this->getMethod() . BashColor::Reset . "\n";

        return $cliString;
    }

    public function printArgs()
    {
        $args = [];
        foreach ($this->args as $arg) {
            $args[] = $arg->printArg();
        }

        $output = join(", ", $args);

        return $output;
    }
} 