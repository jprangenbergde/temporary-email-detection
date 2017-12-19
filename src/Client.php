<?php

namespace TemporaryEmailDetection;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

/**
 * @author Jens Prangenberg <mail@jens-prangenberg.de>
 */
class Client
{
    const API_URL = 'https://api.temporary-email-detection.de';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $value Email or domain
     *
     * @return bool
     */
    public function isTemporary(string $value): bool
    {
        try {
            $response = $this->client->request('GET', sprintf('%s/detect/%s', self::API_URL, $value));
        } catch (GuzzleException $exception) {
            return false;
        }

        $decoded = json_decode($response->getBody()->getContents(), true);

        return (bool)($decoded['temporary'] ?? false);
    }
}