<?php

namespace Joli\Jane\Swagger\Client;

use Ivory\HttpAdapter\Message\MessageFactoryInterface;
use Ivory\HttpAdapter\PsrHttpAdapterInterface;
use Zend\Diactoros\Request;

class Resource
{
    /**
     * @var \Ivory\HttpAdapter\PsrHttpAdapterInterface
     */
    protected $httpClient;

    /**
     * @var \Ivory\HttpAdapter\Message\MessageFactoryInterface
     */
    protected $messageFactory;

    public function __construct(PsrHttpAdapterInterface $httpClient, MessageFactoryInterface $messageFactory)
    {
        $this->httpClient     = $httpClient;
        $this->messageFactory = $messageFactory;
    }
} 
