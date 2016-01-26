<?php

namespace Joli\Jane\OpenApi\Client;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Symfony\Component\Serializer\SerializerInterface;

class Resource
{
    const FETCH_RESPONSE = 'response';
    const FETCH_OBJECT   = 'object';

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var MessageFactory
     */
    protected $messageFactory;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    public function __construct(HttpClient $httpClient, MessageFactory $messageFactory, SerializerInterface $serializer)
    {
        $this->httpClient     = $httpClient;
        $this->messageFactory = $messageFactory;
        $this->serializer     = $serializer;
    }
}
