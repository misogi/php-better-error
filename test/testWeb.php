<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php

use BetterError\BetterError;

$autoloader = require(__DIR__ . '/../vendor/autoload.php');
$autoloader->add('BetterErrorTests\\', __DIR__ . '/../src/BetterErrorTests');
BetterError::register();

class User
{
    function auth($a, $b, $c)
    {
        throw new \Exception("外で例外", 2, new \RuntimeException('中で例外'));
    }

    function login()
    {
        $this->auth(123, "", [1, true, false, new User()]);
    }
}

$u = new User;
$u->login();

?>
</body>
</html>