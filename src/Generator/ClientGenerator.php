<?php

namespace Joli\Jane\Swagger\Generator;

use Doctrine\Common\Inflector\Inflector;
use Joli\Jane\Swagger\Model\Swagger;
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

    public function __construct(OperationManager $operationManager, OperationGenerator $operationGenerator)
    {
        $this->operationManager   = $operationManager;
        $this->operationGenerator = $operationGenerator;
    }

    /**
     * Generate an ast node (which correspond to a class) for a swagger spec
     *
     * @param Swagger $swagger
     * @param string $namespace
     * @param string $suffix
     *
     * @return Node[]
     */
    public function generate(Swagger $swagger, $namespace, $suffix = 'Resource')
    {
        $operationsGrouped = $this->operationManager->buildOperationCollection($swagger);
        $nodes             = [];

        foreach ($operationsGrouped as $group => $operations) {
            $nodes[] = $this->generateClass($group, $operations, $namespace, $suffix);
        }

        return $nodes;
    }

    protected function generateClass($group, $operations, $namespace, $suffix = 'Resource')
    {
        $factory    = new BuilderFactory();
        $name       = $group === 0 ? '' : $group;
        $class      = $factory->class(Inflector::classify($name . $suffix));

        foreach ($operations as $id => $operation) {
            $class->addStmt($this->operationGenerator->generate($id, $operation));
        }

        return $factory->namespace($namespace)
            ->addStmt($class)
            ->getNode();
    }
} 
