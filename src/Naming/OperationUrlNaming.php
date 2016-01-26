<?php

namespace Joli\Jane\OpenApi\Naming;

use Joli\Jane\OpenApi\Operation\Operation;

class OperationUrlNaming implements OperationNamingInterface
{
    public function generateFunctionName(Operation $operation)
    {
        $prefix = strtolower($operation->getMethod());
        $parts  = explode('/', $operation->getPath());
        $parts  = array_filter($parts, function ($part) {
            $part = trim($part);

            if (empty($part)) {
                return false;
            }

            if (preg_match('/^{(.+?)}$/', $part)) {
                return false;
            }

            return true;
        });

        $parts = array_map(function ($part) {
            $part = trim($part);

            return ucfirst($part);
        }, $parts);

        return $prefix . implode('', $parts);
    }
}
