<?php

namespace BetterError;


class BetterError
{
    public function pp(\Exception $e)
    {
        $traces = [];
        foreach ($e->getTrace() as $t) {
            $traces[] = new Trace($t);
        }

        ob_start();
        require 'html.phtml';

        return ob_get_clean();
    }
}