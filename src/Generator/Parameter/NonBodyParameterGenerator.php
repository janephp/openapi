<?php

namespace Joli\Jane\Swagger\Generator\Parameter;

use Doctrine\Common\Inflector\Inflector;
use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Scalar;
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
            $methodParameter->default = $this->getDefaultAsExpr($parameter);
        }

        return $methodParameter;
    }

    /**
     * {@inheritDoc}
     */
    public function generateQueryParamStatements($parameter, Expr $queryParamVariable)
    {
        $statements = [];

        if (!$parameter->getRequired() || $parameter->getDefault() !== null) {
            $statements[] = new Expr\MethodCall($queryParamVariable, 'setDefault', [
                new Node\Arg(new Scalar\String_($parameter->getName())),
                new Node\Arg($this->getDefaultAsExpr($parameter))
            ]);
        }

        if ($parameter->getRequired()) {
            $statements[] = new Expr\MethodCall($queryParamVariable, 'setRequired', [new Node\Arg(new Scalar\String_($parameter->getName()))]);
        }

        return $statements;
    }

    /**
     * Generate a default value as an Expr
     *
     * @param $parameter
     *
     * @return Node
     */
    protected function getDefaultAsExpr($parameter)
    {
        return $this->parser->parse("<?php " . var_export($parameter->getDefault(), true) . ";")[0];
    }

    /**
     * {@inheritDoc}
     */
    public function generateDocParameter($parameter)
    {
        return sprintf('%s $%s %s', 'mixed', Inflector::camelize($parameter->getName()), $parameter->getDescription() ?: '');
    }
} 
