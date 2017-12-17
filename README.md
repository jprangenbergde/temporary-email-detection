# Temporary Email Detection DSK
Simple and clean detection SDK for temporary emails

# Example
```
    <?php
    
    use TemporaryEmailDetection\ClientFactory;
    
    require 'vendor/autoload.php';
    
    $factory = new ClientFactory();
    $client = $factory->factorize();
    
    $isTemporary = $client->isTemporary('mail@0815.ru'); // true
    $isTemporary = $client->isTemporary('mail@jens-prangenberg.de'); // false
 ```