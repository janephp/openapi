<?php

namespace Joli\Jane\Swagger\Client;

use Http\Message\MessageFactory;

class Resource
{
    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var MessageFactory
     */
    protected $messageFactory;

    public function __construct(HttpClient $httpClient, MessageFactory $messageFactory)
    {
        $this->httpClient     = $httpClient;
        $this->messageFactory = $messageFactory;
    }
} 
