<?php

namespace BetterError;


class BetterError
{
    public function pp(\Exception $e)
    {
        foreach ($e->getTrace() as $t) {
            $trace = new Trace();
            $trace->line = empty($t['file']) ? '' : $t['file'];
        }

        ob_start();
        require 'test.phtml';

        return ob_get_clean();
    }
}