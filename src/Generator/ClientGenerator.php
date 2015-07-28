<?php

namespace Joli\Jane\Swagger\Generator;

use Joli\Jane\Swagger\Model\Swagger;
use Joli\Jane\Swagger\Operation\OperationManager;

class ClientGenerator
{
    /**
     * @var \Joli\Jane\Swagger\Operation\OperationManager
     */
    private $operationManager;

    public function __construct(OperationManager $operationManager)
    {
        $this->operationManager = $operationManager;
    }

    public function generate(Swagger $swagger, $name, $namespace, $directory)
    {
        $operations = $this->operationManager->buildOperationCollection($swagger);

        foreach ($operations as $id => $operation) {
            var_dump($id);
        }
    }
} 
