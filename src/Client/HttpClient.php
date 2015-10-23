<?php

namespace Joli\Jane\Swagger\Client;

use Http\Client\HttpClient as HttpPlugClient;
use Psr\Http\Message\RequestInterface;

/**
 * Proxy of HttpClient
 */
class HttpClient
{
    private $client;

    public function __construct(HttpPlugClient $client)
    {
        $this->client = $client;
    }

    /**
     * Send a request
     *
     * @param RequestInterface $request
     * @param array            $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendRequest(RequestInterface $request, array $options = array())
    {
        // @TODO Remove this when underlying library as a plugins system with some to support 1.1 protocol
        // Lots of error due to chunked encoding, transfer encoding, ....
        $request = $request->withProtocolVersion('1.0');

        return $this->client->sendRequest($request);
    }
}
 