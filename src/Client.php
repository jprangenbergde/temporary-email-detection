<?php

namespace TemporaryEmailDetection;

use GuzzleHttp\Client as GuzzleClient;

/**
 * @author Jens Prangenberg <mail@jens-prangenberg.de>
 */
class Client
{
    const API_URL = 'https://api.temporary-email-detection.de';

    /**
     * @var GuzzleClient
     */
    private $client;

    /**
     * @param GuzzleClient $client
     */
    public function __construct(GuzzleClient $client)
    {
        $this->client = $client;
    }

    public function isTemporary(string $value): bool
    {
        $response = $this->client->get(sprintf('%s/detect/%s', self::API_URL, $value));

        $decoded = json_decode($response->getBody()->getContents(), true);

        return (bool) ($decoded['temporary'] ?? false);
    }
}