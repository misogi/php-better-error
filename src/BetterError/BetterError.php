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

        if (php_sapi_name() == 'cli') {
            return $this->printCli($traces);
        } else {
            //CLI版phpでない
            echo '<h1>実行結果</h1>';
            echo '<p>HTMLで返そうかな</p>';
        }

        ob_start();
        require 'html.phtml';

        return ob_get_clean();
    }

    /**
     * @param Trace[] $traces
     * @return string
     */
    private function printCli(array $traces)
    {
        $cliOutput = '';
        foreach($traces as $trace) {
            $cliOutput .= $trace->strippedFile() . ":{$trace->line} " . $trace->getMethod() . "\n";
        }

        return $cliOutput;
    }
}