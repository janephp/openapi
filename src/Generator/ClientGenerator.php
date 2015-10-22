<?php

namespace Joli\Jane\Swagger\Generator;

use Doctrine\Common\Inflector\Inflector;
use Joli\Jane\Generator\Context\Context;
use Joli\Jane\Swagger\Model\Swagger;
use Joli\Jane\Swagger\Naming\OperationNamingInterface;
use Joli\Jane\Swagger\Operation\OperationManager;

use PhpParser\BuilderFactory;
use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Stmt;

class ClientGenerator
{
    /**
     * @var \Joli\Jane\Swagger\Operation\OperationManager
     */
    private $operationManager;

    /**
     * @var OperationGenerator
     */
    private $operationGenerator;

    /**
     * @var OperationNamingInterface
     */
    private $operationNaming;

    public function __construct(OperationManager $operationManager, OperationGenerator $operationGenerator, OperationNamingInterface $operationNaming)
    {
        $this->operationManager   = $operationManager;
        $this->operationGenerator = $operationGenerator;
        $this->operationNaming    = $operationNaming;
    }

    /**
     * Generate an ast node (which correspond to a class) for a swagger spec
     *
     * @param Swagger $swagger
     * @param string  $namespace
     * @param string  $suffix
     * @param Context $context
     *
     * @return Node[]
     */
    public function generate(Swagger $swagger, $namespace, Context $context, $suffix = 'Resource')
    {
        $operationsGrouped = $this->operationManager->buildOperationCollection($swagger);
        $nodes             = [];

        foreach ($operationsGrouped as $group => $operations) {
            $nodes[] = $this->generateClass($group, $operations, $namespace, $context, $suffix);
        }

        return $nodes;
    }

    protected function generateClass($group, $operations, $namespace, Context $context, $suffix = 'Resource')
    {
        $factory    = new BuilderFactory();
        $name       = $group === 0 ? '' : $group;
        $class      = $factory->class(Inflector::classify($name . $suffix));
        $class->extend('Resource');

        foreach ($operations as $operation) {
            $class->addStmt($this->operationGenerator->generate($this->operationNaming->generateFunctionName($operation), $operation, $context));
        }

        return $factory->namespace($namespace . "\\Resource")
            ->addStmt($factory->use('Joli\Jane\Swagger\Client\QueryParam'))
            ->addStmt($factory->use('Joli\Jane\Swagger\Client\Resource'))
            ->addStmt($class)
            ->getNode();
    }
} 
