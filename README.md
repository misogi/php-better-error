[![Code Climate](https://codeclimate.com/github/misogi/php-better-error/badges/gpa.svg)](https://codeclimate.com/github/misogi/php-better-error)

[![Test Coverage](https://codeclimate.com/github/misogi/php-better-error/badges/coverage.svg)](https://codeclimate.com/github/misogi/php-better-error)

[![Circle CI](https://circleci.com/gh/misogi/php-better-error/tree/master.svg?style=svg)](https://circleci.com/gh/misogi/php-better-error/tree/master)

php-better-error
================

Reporting pretty error for PHP.


instration
==========

add better-error to composer.json

```
composer require misogi/php-better-error:dev-master
```

Usage
=====

register error handler

```
// into your bootstrap script
\BetterError\BetterError::register()
```

or, use directly

```php
$ex = new \Exception()
echo \BetterError\BetterError::dump($ex)
```


Todo
====

- User Template
-- (Default, displaying uses [Twitter Bootstrap](http://getbootstrap.com/) for styling)


Author
======

@misogi