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

        foreach ($swagger->getPaths() as $path => $pathItem) {
            if ($pathItem instanceof PathItem) {
                if ($pathItem->getDelete() instanceof SwaggerOperation) {
                    $operationCollection->addOperation(new Operation($pathItem->getDelete(), $path, Operation::DELETE, $swagger->getBasePath()));
                }

                if ($pathItem->getGet() instanceof SwaggerOperation) {
                    $operationCollection->addOperation(new Operation($pathItem->getGet(), $path, Operation::GET, $swagger->getBasePath()));
                }

                if ($pathItem->getHead() instanceof SwaggerOperation) {
                    $operationCollection->addOperation(new Operation($pathItem->getHead(), $path, Operation::HEAD, $swagger->getBasePath()));
                }

                if ($pathItem->getOptions() instanceof SwaggerOperation) {
                    $operationCollection->addOperation(new Operation($pathItem->getOptions(), $path, Operation::OPTIONS, $swagger->getBasePath()));
                }

                if ($pathItem->getPatch() instanceof SwaggerOperation) {
                    $operationCollection->addOperation(new Operation($pathItem->getPatch(), $path, Operation::PATCH, $swagger->getBasePath()));
                }

                if ($pathItem->getPost() instanceof SwaggerOperation) {
                    $operationCollection->addOperation(new Operation($pathItem->getPost(), $path, Operation::POST, $swagger->getBasePath()));
                }

                if ($pathItem->getPut() instanceof SwaggerOperation) {
                    $operationCollection->addOperation(new Operation($pathItem->getPut(), $path, Operation::PUT, $swagger->getBasePath()));
                }
            }
        }

        return $operationCollection;
    }
}
