<?php

namespace BetterErrorTests;

use BetterError\BetterError;

class BetterErrorTest extends \PHPUnit_Framework_TestCase {

    public function testPp() {
        $b = new BetterError();
        $e = new \Exception();
        $out = $b->pp($e);
        $this->AssertTrue(is_string($out));
    }
}
