<?php

namespace Joli\Jane\Swagger;

use Joli\Jane\Swagger\Model\Operation;
use Joli\Jane\Swagger\Model\Swagger;
use Zend\Diactoros\Request;

class VirtualClient
{
    /**
     * @var Model\Swagger
     */
    private $swagger;

    public function __construct(Swagger $swagger)
    {
        $this->swagger = $swagger;
    }

    public function __call($name, $arguments)
    {
        $tokens = preg_split('/(?=[A-Z])/', $name, -1, PREG_SPLIT_NO_EMPTY);

        if (count($tokens) < 2) {
            return null;
        }

        $operationName = 'get'.ucfirst($tokens[0]);
        $method        = strtoupper($tokens[0]);
        unset($tokens[0]);

        $tokens = array_map('strtolower', $tokens);
        $path   = "/" . implode('/', $tokens);

        $operation = $this->swagger->getPaths()[$path]->$operationName();

        return $this->generateRequest($operation, $path, $method, $arguments);
    }

    protected function generateRequest(Operation $operation, $path, $method, $arguments)
    {
        $request = new Request($path, $method);

        var_dump($operation);
        var_dump($path);
        var_dump($method);
        var_dump($arguments);

        return null;
    }
} 
