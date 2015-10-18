<?php

namespace Joli\Jane\Swagger\Naming;

use Joli\Jane\Swagger\Operation\Operation;

interface OperationNamingInterface
{
    public function generateFunctionName(Operation $operation);
}
 