<?php

declare(strict_types=1);

namespace TemporaryEmailDetectionTests;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\TransferException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use TemporaryEmailDetection\Client;
use TemporaryEmailDetection\Exception;

/**
 * @author Jens Prangenberg <mail@jens-prangenberg.de>
 */
final class ClientTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testIsTemporary(): void
    {
        /** @var StreamInterface&MockObject $stream */
        $stream = $this->getMockBuilder(StreamInterface::class)->getMock();
        $stream
            ->expects(self::once())
            ->method('getContents')
            ->willReturn('{"temporary": true}');

        /** @var ResponseInterface&MockObject $response */
        $response = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $response
            ->expects(self::once())
            ->method('getBody')
            ->willReturn($stream);

        /** @var ClientInterface&MockObject $clientInterface */
        $clientInterface = $this->getMockBuilder(ClientInterface::class)->getMock();
        $clientInterface
            ->expects(self::once())
            ->method('request')
            ->willReturn($response);

        $client = new Client($clientInterface);

        $this->assertTrue($client->isTemporary('0-mail.com'));
    }

    /**
     * @throws Exception
     */
    public function testIsNotTemporary(): void
    {
        /** @var StreamInterface&MockObject $stream */
        $stream = $this->getMockBuilder(StreamInterface::class)->getMock();
        $stream
            ->expects(self::once())
            ->method('getContents')
            ->willReturn('{"temporary": false}');

        /** @var ResponseInterface&MockObject $response */
        $response = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $response
            ->expects(self::once())
            ->method('getBody')
            ->willReturn($stream);

        /** @var ClientInterface&MockObject $clientInterface */
        $clientInterface = $this->getMockBuilder(ClientInterface::class)->getMock();
        $clientInterface
            ->expects(self::once())
            ->method('request')
            ->willReturn($response);

        $client = new Client($clientInterface);

        $this->assertFalse($client->isTemporary('jens-prangenberg.de'));
    }

    /**
     * @throws Exception
     */
    public function testWillThrowException(): void
    {
        $this->expectException(Exception::class);

        /** @var ClientInterface&MockObject $clientInterface */
        $clientInterface = $this->getMockBuilder(ClientInterface::class)->getMock();
        $clientInterface
            ->expects(self::once())
            ->method('request')
            ->willThrowException(new TransferException());

        $client = new Client($clientInterface);
        $client->isTemporary('jens-prangenberg.de');
    }

    /**
     * @throws Exception
     */
    public function testWillThrowExceptionCauseInvalidJson(): void
    {
        $this->expectException(Exception::class);

        /** @var StreamInterface&MockObject $stream */
        $stream = $this->getMockBuilder(StreamInterface::class)->getMock();
        $stream
            ->expects(self::once())
            ->method('getContents')
            ->willReturn('example');

        /** @var ResponseInterface&MockObject $response */
        $response = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $response
            ->expects(self::once())
            ->method('getBody')
            ->willReturn($stream);

        /** @var ClientInterface&MockObject $clientInterface */
        $clientInterface = $this->getMockBuilder(ClientInterface::class)->getMock();
        $clientInterface
            ->expects(self::once())
            ->method('request')
            ->willReturn($response);

        $client = new Client($clientInterface);
        $client->isTemporary('jens-prangenberg.de');
    }
}
