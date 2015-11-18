<?php

namespace Joli\Jane\Swagger\Tests\Expected\Resource;

use Joli\Jane\Swagger\Client\QueryParam;
use Joli\Jane\Swagger\Client\Resource;
class TestResource extends Resource
{
    /**
     * @param array $parameters
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getTest($parameters = array())
    {
        $queryParam = new QueryParam();
        $url = sprintf('/test?%s', $queryParam->buildQueryString($parameters));
        $request = $this->messageFactory->createRequest('GET', $url, $queryParam->buildHeaders($parameters), null);
        $response = $this->httpClient->sendRequest($request);
        return $response;
    }
}
