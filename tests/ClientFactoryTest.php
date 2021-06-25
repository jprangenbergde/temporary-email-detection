<?php

namespace TemporaryEmailDetectionTests;

use PHPUnit\Framework\TestCase;
use TemporaryEmailDetection\Client;
use TemporaryEmailDetection\ClientFactory;
use TemporaryEmailDetection\ClientInterface;

/**
 * @author Jens Prangenberg <mail@jens-prangenberg.de>
 */
class ClientFactoryTest extends TestCase
{
    public function testFactorize(): void
    {
        $factory = new ClientFactory();

        $this->assertInstanceOf(ClientInterface::class, $factory->factorize());
        $this->assertInstanceOf(Client::class, $factory->factorize());
    }
}
