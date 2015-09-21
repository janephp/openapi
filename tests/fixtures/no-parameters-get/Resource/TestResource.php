<?php

namespace Joli\Jane\Swagger\Tests\Expected\Resource;

use Joli\Jane\Swagger\Client\Resource;
use Ivory\HttpAdapter\Message\RequestInterface;
use Zend\Diactoros\Request;
class TestResource extends Resource
{
    /**
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getTest()
    {
        $response = $this->httpClient->sendRequest($this->messageFactory->createRequest('/test', 'GET', RequestInterface::PROTOCOL_VERSION_1_1, array(), null));
        $response = $response->withoutHeader('jane-serializer');
        return $response;
    }
}