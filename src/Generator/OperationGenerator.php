<?php

namespace Joli\Jane\Swagger\Generator;

use Joli\Jane\Swagger\Generator\Parameter\BodyParameterGenerator;
use Joli\Jane\Swagger\Generator\Parameter\FormDataParameterGenerator;
use Joli\Jane\Swagger\Generator\Parameter\HeaderParameterGenerator;
use Joli\Jane\Swagger\Generator\Parameter\PathParameterGenerator;
use Joli\Jane\Swagger\Generator\Parameter\QueryParameterGenerator;
use Joli\Jane\Swagger\Model\BodyParameter;
use Joli\Jane\Swagger\Model\FormDataParameterSubSchema;
use Joli\Jane\Swagger\Model\HeaderParameterSubSchema;
use Joli\Jane\Swagger\Model\PathParameterSubSchema;
use Joli\Jane\Swagger\Model\QueryParameterSubSchema;
use Joli\Jane\Swagger\Operation\Operation;

use PhpParser\Node\Expr;
use PhpParser\Node\Stmt;

class OperationGenerator
{
    /**
     * @var Parameter\BodyParameterGenerator
     */
    private $bodyParameterGenerator;

    /**
     * @var Parameter\FormDataParameterGenerator
     */
    private $formDataParameterGenerator;

    /**
     * @var Parameter\HeaderParameterGenerator
     */
    private $headerParameterGenerator;

    /**
     * @var Parameter\PathParameterGenerator
     */
    private $pathParameterGenerator;

    /**
     * @var Parameter\QueryParameterGenerator
     */
    private $queryParameterGenerator;

    public function __construct(BodyParameterGenerator $bodyParameterGenerator, FormDataParameterGenerator $formDataParameterGenerator, HeaderParameterGenerator $headerParameterGenerator, PathParameterGenerator $pathParameterGenerator, QueryParameterGenerator $queryParameterGenerator)
    {
        $this->bodyParameterGenerator     = $bodyParameterGenerator;
        $this->formDataParameterGenerator = $formDataParameterGenerator;
        $this->headerParameterGenerator   = $headerParameterGenerator;
        $this->pathParameterGenerator     = $pathParameterGenerator;
        $this->queryParameterGenerator    = $queryParameterGenerator;
    }

    /**
     * Generate a method for an operation
     *
     * @param string    $name
     * @param Operation $operation
     *
     * @return Stmt\ClassMethod
     */
    public function generate($name, Operation $operation)
    {
        $methodParameters = [];

        foreach ($operation->getOperation()->getParameters() as $parameter) {
            if ($parameter instanceof BodyParameter) {
                $methodParameters[] = $this->bodyParameterGenerator->generateMethodParameter($parameter);
            }

            if ($parameter instanceof FormDataParameterSubSchema) {
                $methodParameters[] = $this->formDataParameterGenerator->generateMethodParameter($parameter);
            }

            if ($parameter instanceof HeaderParameterSubSchema) {
                $methodParameters[] = $this->headerParameterGenerator->generateMethodParameter($parameter);
            }

            if ($parameter instanceof PathParameterSubSchema) {
                $methodParameters[] = $this->pathParameterGenerator->generateMethodParameter($parameter);
            }

            if ($parameter instanceof QueryParameterSubSchema) {
                $methodParameters[] = $this->queryParameterGenerator->generateMethodParameter($parameter);
            }
        }

        return new Stmt\ClassMethod($name, [
            'type' => Stmt\Class_::MODIFIER_PUBLIC,
            'params' => $methodParameters
        ]);
    }
} 
