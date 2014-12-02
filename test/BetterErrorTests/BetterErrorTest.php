<?php

namespace BetterErrorTests;

class BetterErrorTest extends \PHPUnit_Framework_TestCase {

    public function testPp() {
        $b = new \BetterError\BetterError();
        $e = new \Exception();
        $out = $b->pp($e);
        $this->AssertTrue(is_string($out));
    }

}
 