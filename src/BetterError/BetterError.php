<?php

namespace BetterError;

class BetterError
{
    public function pp(\Exception $e)
    {
        $output = "";
        foreach ($e->getTrace() as $trace) {
            $fileName = empty($trace['file']) ? '' : $trace['file'];
            $output .= $fileName;
        }

        return $output;
    }
}