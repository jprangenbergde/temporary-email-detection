# Temporary Email Detection SDK
Simple and clean SDK for https://temporary-email-detection.de

## Packagist
https://packagist.org/packages/jprangenbergde/temporary-email-detection

## Installation
```
composer require jprangenbergde/temporary-email-detection
```

## Example
```
    <?php
    
    use TemporaryEmailDetection\ClientFactory;
    
    require 'vendor/autoload.php';
    
    $factory = new ClientFactory();
    $client = $factory->factorize();
    
    $isTemporary = $client->isTemporary('mail@0815.ru'); // true
    $isTemporary = $client->isTemporary('mail@jens-prangenberg.de'); // false
 ```
