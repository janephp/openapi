<?php

namespace Joli\Jane\Swagger\Generator;

use Joli\Jane\Jane;
use Joli\Jane\Reference\Resolver;
use Joli\Jane\Swagger\Generator\Parameter\BodyParameterGenerator;
use Joli\Jane\Swagger\Generator\Parameter\FormDataParameterGenerator;
use Joli\Jane\Swagger\Generator\Parameter\HeaderParameterGenerator;
use Joli\Jane\Swagger\Generator\Parameter\PathParameterGenerator;
use Joli\Jane\Swagger\Generator\Parameter\QueryParameterGenerator;
use Joli\Jane\Swagger\Operation\OperationManager;
use PhpParser\Lexer;
use PhpParser\Parser;

class GeneratorFactory
{
    static public function build()
    {
        $parser = new Parser(new Lexer());

        $bodyParameter     = new BodyParameterGenerator($parser);
        $pathParameter     = new PathParameterGenerator($parser);
        $formDataParameter = new FormDataParameterGenerator($parser);
        $headerParameter   = new HeaderParameterGenerator($parser);
        $queryParameter    = new QueryParameterGenerator($parser);
        $resolver          = new Resolver(Jane::buildSerializer());

        $operation = new OperationGenerator($resolver, $bodyParameter, $formDataParameter, $headerParameter, $pathParameter, $queryParameter);
        $operationManager = new OperationManager();
        $client = new ClientGenerator($operationManager, $operation);

        return $client;
    }
} 
