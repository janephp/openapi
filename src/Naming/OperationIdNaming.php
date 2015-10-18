<?php

namespace Joli\Jane\Swagger\Naming;

use Doctrine\Common\Inflector\Inflector;
use Joli\Jane\Swagger\Operation\Operation;

class OperationIdNaming implements OperationNamingInterface
{
    public function generateFunctionName(Operation $operation)
    {
        return Inflector::camelize($operation->getOperation()->getOperationId());
    }
}
 