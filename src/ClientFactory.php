<?php

declare(strict_types=1);

namespace TemporaryEmailDetection;

use GuzzleHttp\Client as GuzzleClient;

/**
 * @author Jens Prangenberg <mail@jens-prangenberg.de>
 */
final class ClientFactory implements ClientFactoryInterface
{
    public function factorize(): ClientInterface
    {
        return new Client(new GuzzleClient());
    }
}
