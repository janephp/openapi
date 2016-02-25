<?php

namespace Joli\Jane\OpenApi\Naming;

use Joli\Jane\OpenApi\Operation\Operation;

class OperationUrlNaming implements OperationNamingInterface
{
    public function generateFunctionName(Operation $operation)
    {
        $prefix = strtolower($operation->getMethod());

        $methodName = preg_replace_callback(
            '/((?P<separator>[^a-zA-Z0-9])+(?P<part>[a-zA-Z0-9]*))/',
            function($matches) {
                if ($matches['separator'] === '.') {
                    return '';
                }

                return ucfirst($matches['part']);
            },
            $operation->getPath()
        );

        return $prefix . $methodName;
    }
}
