<?php

namespace BetterErrorTests;

use BetterError\Trace;

class TraceTest extends \PHPUnit_Framework_TestCase
{
    public function testNew()
    {
        $ex = new \Exception();
        $traces = $ex->getTrace();
        $t = new Trace($traces[0]);
        $this->AssertSame($t->class, 'BetterErrorTests\TraceTest');
    }
}
 