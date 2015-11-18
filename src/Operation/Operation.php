<?php

namespace Joli\Jane\Swagger\Operation;

use Joli\Jane\Swagger\Model\Operation as SwaggerOperation;

class Operation
{
    const DELETE  = 'DELETE';
    const GET     = 'GET';
    const POST    = 'POST';
    const PUT     = 'PUT';
    const PATCH   = 'PATCH';
    const OPTIONS = 'OPTIONS';
    const HEAD    = 'HEAD';

    /**
     * @var \Joli\Jane\Swagger\Model\Operation
     */
    private $operation;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $method;

    public function __construct(SwaggerOperation $operation, $path, $method, $basePath = "")
    {
        $this->operation = $operation;
        $this->path      = $basePath . $path;
        $this->method    = $method;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return \Joli\Jane\Swagger\Model\Operation
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
} 
