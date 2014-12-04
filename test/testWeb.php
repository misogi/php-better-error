<html>
<body>
<?php

use BetterError\BetterError;

$autoloader = require(__DIR__ . '/../vendor/autoload.php');
$autoloader->add('BetterErrorTests\\', __DIR__ . '/../src/BetterErrorTests');
\BetterError\BetterError::register();

echo BetterError::pp(new \Exception());

?>
</body>
</html>