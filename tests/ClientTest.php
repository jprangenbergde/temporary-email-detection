<?php

namespace TemporaryEmailDetectionTests;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\TransferException;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use TemporaryEmailDetection\Client;
use TemporaryEmailDetection\Exception;

/**
 * @author Jens Prangenberg <mail@jens-prangenberg.de>
 */
class ClientTest extends TestCase
{
    /**
     * @return void
     * @throws Exception
     */
    public function testIsTemporary(): void
    {
        /** @var StreamInterface|PHPUnit_Framework_MockObject_MockObject $stream */
        $stream = $this->getMockBuilder(StreamInterface::class)->getMock();
        $stream
            ->expects($this->once())
            ->method('getContents')
            ->willReturn('{"temporary": true}');

        /** @var ResponseInterface|PHPUnit_Framework_MockObject_MockObject $response */
        $response = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn($stream);

        /** @var ClientInterface|PHPUnit_Framework_MockObject_MockObject $clientInterface */
        $clientInterface = $this->getMockBuilder(ClientInterface::class)->getMock();
        $clientInterface
            ->expects($this->once())
            ->method('request')
            ->willReturn($response);

        $client = new Client($clientInterface);

        $this->assertTrue($client->isTemporary('0-mail.com'));
    }

    /**
     * @return void
     * @throws Exception
     */
    public function testIsNotTemporary(): void
    {
        /** @var StreamInterface|PHPUnit_Framework_MockObject_MockObject $stream */
        $stream = $this->getMockBuilder(StreamInterface::class)->getMock();
        $stream
            ->expects($this->once())
            ->method('getContents')
            ->willReturn('{"temporary": false}');

        /** @var ResponseInterface|PHPUnit_Framework_MockObject_MockObject $response */
        $response = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn($stream);

        /** @var ClientInterface|PHPUnit_Framework_MockObject_MockObject $clientInterface */
        $clientInterface = $this->getMockBuilder(ClientInterface::class)->getMock();
        $clientInterface
            ->expects($this->once())
            ->method('request')
            ->willReturn($response);

        $client = new Client($clientInterface);

        $this->assertFalse($client->isTemporary('jens-prangenberg.de'));
    }

    /**
     * @return void
     * @throws Exception
     * @expectedException Exception
     */
    public function testWillThrowException(): void
    {
        /** @var ClientInterface|PHPUnit_Framework_MockObject_MockObject $clientInterface */
        $clientInterface = $this->getMockBuilder(ClientInterface::class)->getMock();
        $clientInterface
            ->expects($this->once())
            ->method('request')
            ->willThrowException(new TransferException());

        $client = new Client($clientInterface);
        $client->isTemporary('jens-prangenberg.de');
    }
}

