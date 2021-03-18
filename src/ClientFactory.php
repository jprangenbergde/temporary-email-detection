<?php

namespace TemporaryEmailDetection;

use GuzzleHttp\Client as GuzzleClient;

/**
 * @author Jens Prangenberg <mail@jens-prangenberg.de>
 */
class ClientFactory
{
    /**
     * @return Client
     */
    public function factorize(): Client
    {
        return new Client(new GuzzleClient());
    }
}
