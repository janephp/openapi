<?php

namespace Joli\Jane\OpenApi\Tests\Expected\Resource;

use Joli\Jane\OpenApi\Runtime\Client\QueryParam;
use Joli\Jane\OpenApi\Runtime\Client\Resource;

class ContainerResource extends Resource
{
    /**
     * @param mixed $body       Container to create
     * @param array $parameters {
     *
     *     @var string $name Assign the specified name to the container. Must match `/?[a-zA-Z0-9_-]+`.
     * }
     *
     * @param string $fetch Fetch mode (object or response)
     *
     * @return \Psr\Http\Message\ResponseInterface|\Joli\Jane\OpenApi\Tests\Expected\Model\ContainersCreateResponse201
     */
    public function containerCreate($body, $parameters = [], $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam();
        $queryParam->setDefault('name', null);
        $url     = '/v1.30/containers/create';
        $url     = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers = array_merge(['Host' => 'localhost', 'Accept' => ['application/json'], 'Content-Type' => 'application/json'], $queryParam->buildHeaders($parameters));
        $body    = $body;
        $request = $this->messageFactory->createRequest('POST', $url, $headers, $body);
        $promise = $this->httpClient->sendAsyncRequest($request);
        if (self::FETCH_PROMISE === $fetch) {
            return $promise;
        }
        $response = $promise->wait();
        if (self::FETCH_OBJECT == $fetch) {
            if ('201' == $response->getStatusCode()) {
                return $this->serializer->deserialize((string) $response->getBody(), 'Joli\\Jane\\OpenApi\\Tests\\Expected\\Model\\ContainersCreateResponse201', 'json');
            }
        }

        return $response;
    }
}
