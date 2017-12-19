<?php

namespace TemporaryEmailDetectionTests;

use PHPUnit\Framework\TestCase;
use TemporaryEmailDetection\Client;
use TemporaryEmailDetection\ClientFactory;

/**
 * @author Jens Prangenberg <mail@jens-prangenberg.de>
 */
class ClientFactoryTest extends TestCase
{
    /**
     * @return void
     */
    public function testFactorize(): void
    {
        $factory = new ClientFactory();

        $this->assertInstanceOf(Client::class, $factory->factorize());
    }
}

