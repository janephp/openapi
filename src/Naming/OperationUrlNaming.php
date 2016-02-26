<?php

namespace Joli\Jane\OpenApi\Naming;

use Doctrine\Common\Inflector\Inflector;
use Joli\Jane\OpenApi\Model\Response;
use Joli\Jane\OpenApi\Model\Schema;
use Joli\Jane\OpenApi\Operation\Operation;

class OperationUrlNaming implements OperationNamingInterface
{
    public function generateFunctionName(Operation $operation)
    {
        $prefix = strtolower($operation->getMethod());

        $response = $operation->getOperation()->getResponses()[200];

        $shouldSingularize = !($response instanceof Response && $response->getSchema() instanceof Schema && $response->getSchema()->getType() === 'array');

        preg_match_all('/(?P<separator>[^a-zA-Z0-9{}])+(?P<part>[a-zA-Z0-9{}]*)/', $operation->getPath(), $matches);

        $methodNameParts = [];
        $lastNonParameterPartIndex = 0;

        foreach ($matches[0] as $index => $match) {
            if ($matches['separator'][$index] === '.') {
                continue;
            }

            $part = $matches['part'][$index];

            if (preg_match_all('/{(?P<parameter>[^{}]+)}/', $part, $parameterMatches)) {
                foreach($parameterMatches[0] as $parameterIndex => $parameterMatch) {
                    $methodNameParts[] =  'By' . ucfirst($parameterMatches['parameter'][$parameterIndex]);
                }
            } else {
                $methodNameParts[] = ucfirst($part);
                $lastNonParameterPartIndex = count($methodNameParts) - 1;
            }
        }

        if ($shouldSingularize && count($methodNameParts) > 0) {
            $methodNameParts[$lastNonParameterPartIndex] = Inflector::singularize($methodNameParts[$lastNonParameterPartIndex]);
        }

        return $prefix . ucfirst(implode('', $methodNameParts));
    }
}
