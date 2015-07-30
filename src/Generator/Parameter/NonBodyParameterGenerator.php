<?php

namespace Joli\Jane\Swagger\Generator\Parameter;

use Doctrine\Common\Inflector\Inflector;
use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Stmt;

abstract class NonBodyParameterGenerator extends ParameterGenerator
{
    /**
     * {@inheritDoc}
     */
    public function generateMethodParameter($parameter)
    {
        $name            = Inflector::camelize($parameter->getName());
        $methodParameter = new Node\Param($name);

        if (!$parameter->getRequired() || $parameter->getDefault() !== null) {
            $default = $this->parser->parse("<?php " . var_export($parameter->getDefault(), true) . ";");

            $methodParameter->default = $default[0];
        }

        return $methodParameter;
    }
} 
