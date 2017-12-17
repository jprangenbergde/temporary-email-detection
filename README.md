# Temporary Email Detection SDK
Simple and clean SDK for https://temporary-email-detection.de

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
