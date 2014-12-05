<?php

namespace BetterErrorTests;

use BetterError\Exception;

class ExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testNew()
    {
        $ex = new Exception(new \Exception('error!'));
        $this->assertSame($ex->message, 'error!');
    }
}
 