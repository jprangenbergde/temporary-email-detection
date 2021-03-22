<?php

declare(strict_types=1);

namespace TemporaryEmailDetection;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

/**
 * @author Jens Prangenberg <mail@jens-prangenberg.de>
 */
final class Client
{
    private const API_URL = 'https://api.temporary-email-detection.de';

    private ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $value Email or domain
     *
     * @return bool
     * @throws Exception
     */
    public function isTemporary(string $value): bool
    {
        try {
            $response = $this->client->request('GET', sprintf('%s/detect/%s', self::API_URL, $value));

            $decoded = json_decode(
                $response->getBody()->getContents(),
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        } catch (GuzzleException | JsonException $exception) {
            throw Exception::fromMessage($exception->getMessage());
        }

        return (bool) ($decoded['temporary'] ?? false);
    }
}
