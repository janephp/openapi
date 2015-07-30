<?php

namespace Joli\Jane\Swagger\Generator\Parameter;

use Doctrine\Common\Inflector\Inflector;
use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Stmt;

class BodyParameterGenerator extends ParameterGenerator
{
    /**
     * {@inheritDoc}
     */
    public function generateMethodParameter($parameter)
    {
        $name            = Inflector::camelize($parameter->getName());
        $methodParameter = new Node\Param($name);

        return $methodParameter;
    }
} 
