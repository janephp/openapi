<?php

namespace Joli\Jane\Swagger\Generator\Parameter;

use PhpParser\Node;
use PhpParser\Parser;

abstract class ParameterGenerator
{
    /**
     * @var Parser
     */
    protected $parser;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param $parameter
     *
     * @return Node\Param
     */
    abstract public function generateMethodParameter($parameter);

    /**
     * @param $parameter
     *
     * @return string
     */
    abstract public function generateDocParameter($parameter);
} 
