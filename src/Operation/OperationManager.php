<?php

namespace Joli\Jane\Swagger\Operation;

use Joli\Jane\Swagger\Model\Operation as SwaggerOperation;
use Joli\Jane\Swagger\Model\PathItem;
use Joli\Jane\Swagger\Model\Swagger;

class OperationManager
{
    public function buildOperationCollection(Swagger $swagger)
    {
        $operationCollection = new OperationCollection();
        $host = $swagger->getHost() === null ? 'localhost' : $swagger->getHost();

        foreach ($swagger->getPaths() as $path => $pathItem) {
            if ($pathItem instanceof PathItem) {
                if ($pathItem->getDelete() instanceof SwaggerOperation) {
                    $operationCollection->addOperation(new Operation($pathItem->getDelete(), $path, Operation::DELETE, $swagger->getBasePath(), $host));
                }

                if ($pathItem->getGet() instanceof SwaggerOperation) {
                    $operationCollection->addOperation(new Operation($pathItem->getGet(), $path, Operation::GET, $swagger->getBasePath(), $host));
                }

                if ($pathItem->getHead() instanceof SwaggerOperation) {
                    $operationCollection->addOperation(new Operation($pathItem->getHead(), $path, Operation::HEAD, $swagger->getBasePath(), $host));
                }

                if ($pathItem->getOptions() instanceof SwaggerOperation) {
                    $operationCollection->addOperation(new Operation($pathItem->getOptions(), $path, Operation::OPTIONS, $swagger->getBasePath(), $host));
                }

                if ($pathItem->getPatch() instanceof SwaggerOperation) {
                    $operationCollection->addOperation(new Operation($pathItem->getPatch(), $path, Operation::PATCH, $swagger->getBasePath(), $host));
                }

                if ($pathItem->getPost() instanceof SwaggerOperation) {
                    $operationCollection->addOperation(new Operation($pathItem->getPost(), $path, Operation::POST, $swagger->getBasePath(), $host));
                }

                if ($pathItem->getPut() instanceof SwaggerOperation) {
                    $operationCollection->addOperation(new Operation($pathItem->getPut(), $path, Operation::PUT, $swagger->getBasePath(), $host));
                }
            }
        }

        return $operationCollection;
    }
}
