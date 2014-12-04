<?php

$autoloader = require(__DIR__ . '/../vendor/autoload.php');
$autoloader->add('BetterErrorTests\\', __DIR__ . '/../src/BetterErrorTests');
\BetterError\BetterError::register();
