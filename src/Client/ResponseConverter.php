<?php

namespace Joli\Jane\Swagger\Client;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\Serializer;

class ResponseConverter
{
    private $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * Convert a response into the object wanted
     *
     * @param ResponseInterface $response
     *
     * @return null|object
     */
    public function convert(ResponseInterface $response)
    {
        if ($response->hasHeader('jane-serializer')) {
            $class = $response->getHeader('jane-serializer')[0];

            if ($response->hasHeader('jane-serializer-array')) {
                return $this->serializer->deserialize($response->getBody()->getContents(), 'array<'.$class.'>', 'json');
            }

            return $this->serializer->deserialize($response->getBody()->getContents(), $class, 'json');
        }

        return null;
    }
} 
