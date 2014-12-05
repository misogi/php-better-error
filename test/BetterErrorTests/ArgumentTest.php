<?php

namespace BetterErrorTests;


use BetterError\Argument;

class ArgumentTest extends \PHPUnit_Framework_TestCase
{

    public function testNew()
    {
        $args = [1, 'string', 2.5, [true, false], new \Exception(), []];

        foreach($args as $arg) {
            $a = new Argument($arg);
            $this->AssertFalse(empty($a->type));
        }
    }

}
 