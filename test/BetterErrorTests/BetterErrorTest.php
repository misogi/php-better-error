<?php

namespace BetterErrorTests;

use BetterError\BetterError;
use BetterError\Exception;

class BetterErrorTest extends \PHPUnit_Framework_TestCase
{
    public function testPp() {
        $b = new BetterError();
        $e = new \Exception();
        $out = $b->dump($e);
        $this->AssertTrue(is_string($out));
    }

    public function testPrintHtml()
    {
        $e = new \Exception('err', 32, new \Exception('inner', 1));
        $betterEx = new Exception($e);
        $out = BetterError::printHtml($betterEx);
        $this->assertTrue(is_string($out));
    }
}
