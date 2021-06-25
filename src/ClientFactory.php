<?php

namespace TemporaryEmailDetection;

use GuzzleHttp\Client as GuzzleClient;

/**
 * @author Jens Prangenberg <mail@jens-prangenberg.de>
 */
class ClientFactory
{
    public function factorize(): ClientInterface
    {
        return new Client(new GuzzleClient());
    }
}
