# Germania KG · Random

**[Pimple Service Provider](https://pimple.symfony.com/#extending-a-container) for creating a Random Generator from ircmaxells' [RandomLib](https://github.com/ircmaxell/RandomLib)**


[![Packagist](https://img.shields.io/packagist/v/germania-kg/random.svg?style=flat)](https://packagist.org/packages/germania-kg/random)
[![PHP version](https://img.shields.io/packagist/php-v/germania-kg/random.svg)](https://packagist.org/packages/germania-kg/random)
[![Build Status](https://img.shields.io/travis/GermaniaKG/Random.svg?label=Travis%20CI)](https://travis-ci.org/GermaniaKG/Random)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GermaniaKG/Random/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Random/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/GermaniaKG/Random/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Random/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/GermaniaKG/Random/badges/build.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Random/build-status/master)


## Installation

```bash
$ composer require germania-kg/random
```

## Setup

```php
<?php
use Germania\Random\RandomServiceProvider;

// A. Use with Slim or Pimple
$app = new \Slim\App;
$dic = $app->getContainer();
$dic = new Pimple\Container;

// B. Register Service Provider.
// Optionally pass length and strenth:
$rsp = new RandomServiceProvider;
$rsp = new RandomServiceProvider( 240, 5);

$dic->register( $rsp  );
```


## Services

### RandomGenerator

Returns a *RandomLib\Generator* instance. See [RandomLib docs](https://github.com/ircmaxell/RandomLib#generator) on how to deal with it.

```php
$generator = $dic['RandomGenerator'];
$str = $generator->generateString(32, 'abcdef');
```


### RandomGenerator.Callable

Returns a Callable wrapper around the *RandomLib\Generator* instance which creates a random string af arbitrary length. The callable accepts an optional string length.

```php
$random_callable = $dic['RandomGenerator.Callable'];
$str = $random_callable(); // 256 characters
$str = $random_callable( 256 ); // 256 chars
$str = $random_callable( 64 ); // 64 chars.

```

### RandomGenerator.Strength

Returns the *\SecurityLib\Strength* instance used for creating the *RandomLib\Generator*

```php
$strength = $dic['RandomGenerator.Strength'];
```

### RandomGenerator.Length

Returns the default length of generated random strings.

```php
$length = $dic['RandomGenerator.Length'];
```


## Development

```bash
$ git clone https://github.com/GermaniaKG/Random.git
$ cd Random
$ composer install
```

## Unit tests

Either copy `phpunit.xml.dist` to `phpunit.xml` and adapt to your needs, or leave as is. Run [PhpUnit](https://phpunit.de/) test or composer scripts like this:

```bash
$ composer test
# or
$ vendor/bin/phpunit
```

