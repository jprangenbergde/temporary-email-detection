# Temporary Email Detection SDK
Simple and clean SDK for https://temporary-email-detection.de

[![Build Status](https://travis-ci.org/jprangenbergde/temporary-email-detection.svg?branch=master)](https://travis-ci.org/jprangenbergde/temporary-email-detection)
[![Coverage Status](https://coveralls.io/repos/github/jprangenbergde/temporary-email-detection/badge.svg?branch=master)](https://coveralls.io/github/jprangenbergde/temporary-email-detection?branch=master)

## Packagist
https://packagist.org/packages/jprangenbergde/temporary-email-detection

## Installation
```
composer require jprangenbergde/temporary-email-detection
```

## Example
```php
<?php
    
use TemporaryEmailDetection\ClientFactory;
    
require 'vendor/autoload.php';
    
$factory = new ClientFactory();
$client = $factory->factorize();
    
$isTemporary = $client->isTemporary('mail@0815.ru'); // true
$isTemporary = $client->isTemporary('jens-prangenberg.de'); // false
 ```
## Extensions
Laravel: https://github.com/Dropelikeit/temporary-email-validator

Symfony: https://github.com/Dropelikeit/temporary-email-validator-bundle

Laminas / Mezzio: https://github.com/Dropelikeit/laminas-temporary-email-validator
