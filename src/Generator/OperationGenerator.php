<?php

namespace Joli\Jane\Swagger\Generator;

use Joli\Jane\Generator\Context\Context;
use Joli\Jane\Reference\Reference;
use Joli\Jane\Reference\Resolver;
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
use Joli\Jane\Swagger\Model\Schema;
use Joli\Jane\Swagger\Operation\Operation;

use PhpParser\Node\Arg;
use PhpParser\Node\Expr;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt;
use PhpParser\Node\Scalar;
use PhpParser\Comment;

class OperationGenerator
{
    /**
     * @var \Joli\Jane\Reference\Resolver
     */
    private $resolver;

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

    public function __construct(Resolver $resolver, BodyParameterGenerator $bodyParameterGenerator, FormDataParameterGenerator $formDataParameterGenerator, HeaderParameterGenerator $headerParameterGenerator, PathParameterGenerator $pathParameterGenerator, QueryParameterGenerator $queryParameterGenerator)
    {
        $this->resolver                   = $resolver;
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
     * @param Context   $context
     *
     * @return Stmt\ClassMethod
     */
    public function generate($name, Operation $operation, Context $context)
    {
        $methodParameters = [];
        $documentation    = ['/**'];
        $bodyParameter    = null;
        $headerParameters = [];
        $defaults         = [];
        $required         = [];
        $formParameters   = [];
        $headerParameters = [];

        if ($operation->getOperation()->getDescription()) {
            $documentation[] = sprintf(" * %s", $operation->getOperation()->getDescription());
        }

        if ($operation->getOperation()->getParameters()) {
            $documentation[] = " * ";

            foreach ($operation->getOperation()->getParameters() as $parameter) {
                if ($parameter instanceof BodyParameter) {
                    $methodParameters[] = $this->bodyParameterGenerator->generateMethodParameter($parameter);
                    $documentation[]    = sprintf(' * @param %s', $this->bodyParameterGenerator->generateDocParameter($parameter));
                    $bodyParameter      = $parameter;
                }

                if ($parameter instanceof FormDataParameterSubSchema) {
                    $this->formDataParameterGenerator->populateQueryParam($defaults, $required, $formParameters, $headerParameters);
                    $documentation[]    = sprintf(' * @param %s', $this->formDataParameterGenerator->generateDocParameter($parameter));
                }

                if ($parameter instanceof HeaderParameterSubSchema) {
                    $methodParameters[] = $this->headerParameterGenerator->generateMethodParameter($parameter);
                    $documentation[]    = sprintf(' * @param %s', $this->headerParameterGenerator->generateDocParameter($parameter));
                    $headerParameters[] = $parameter;
                }

                if ($parameter instanceof PathParameterSubSchema) {
                    $this->formDataParameterGenerator->populateQueryParam($defaults, $required, $formParameters, $headerParameters);
                    $documentation[]    = sprintf(' * @param %s', $this->pathParameterGenerator->generateDocParameter($parameter));
                }

                if ($parameter instanceof QueryParameterSubSchema) {
                    $methodParameters[] = $this->queryParameterGenerator->generateMethodParameter($parameter);
                    $documentation[]    = sprintf(' * @param %s', $this->pathParameterGenerator->generateDocParameter($parameter));
                }
            }
        }

        $documentation[] = " *";
        $documentation[] = " * @return \\Psr\\Http\\Message\\ResponseInterface";
        $documentation[] = " */";
        $methodBody = [
            new Expr\Assign(new Expr\Variable('response'), new Expr\MethodCall(new Expr\PropertyFetch(new Expr\Variable('this'), 'httpClient'), 'sendRequest', [
                new Arg(
                    new Expr\MethodCall(
                        new Expr\PropertyFetch(new Expr\Variable('this'), 'messageFactory'),
                        'createRequest', [
                            new Arg(new Scalar\String_($operation->getPath())),
                            new Arg(new Scalar\String_($operation->getMethod())),
                            new Arg(new Expr\ClassConstFetch(new Name('RequestInterface'), 'PROTOCOL_VERSION_1_1')),
                            new Arg(new Expr\Array_()),
                            new Arg($bodyParameter === null ? new Expr\ConstFetch(new Name('null')) : new Expr\Variable($bodyParameter->getName()))
                        ]
                    )
                )
            ])),
            new Expr\Assign(new Expr\Variable('response'), new Expr\MethodCall(new Expr\Variable('response'), 'withoutHeader', [
                new Arg(new Scalar\String_('jane-serializer'))
            ]))
        ];

        foreach ($operation->getOperation()->getResponses() as $status => $response) {
            $schema         = $response->getSchema();
            $resolvedSchema = null;
            $addStmts       = [];

            if ($schema instanceof Reference) {
                $resolvedSchema = $this->resolver->resolve($schema);
            }

            if ($schema instanceof Schema && $schema->getType() === "array" && $schema->getItems() instanceof Reference) {
                $resolvedSchema = $this->resolver->resolve($schema->getItems());
                $addStmts[] = new Expr\Assign(new Expr\Variable('response'), new Expr\MethodCall(new Expr\Variable('response'), 'withHeader', [
                    new Arg(new Scalar\String_('jane-serializer-array')),
                    new Arg(new Scalar\String_('true'))
                ]));
            }

            if ($resolvedSchema !== null && isset($context->getObjectClassMap()[spl_object_hash($resolvedSchema)])) {
                $class = $context->getObjectClassMap()[spl_object_hash($resolvedSchema)];

                $methodBody[] = new Stmt\If_(
                    new Expr\BinaryOp\Equal(
                        new Scalar\String_($status),
                        new Expr\MethodCall(new Expr\Variable('response'), 'getStatusCode')
                    ), [
                        'stmts' => array_merge($addStmts, [
                            new Expr\Assign(new Expr\Variable('response'), new Expr\MethodCall(new Expr\Variable('response'), 'withHeader', [
                                new Arg(new Scalar\String_('jane-serializer')),
                                new Arg(new Scalar\String_($context->getNamespace() . "\\Model\\" . $class->getName()))
                            ]))
                        ])
                    ]
                );
            }
        }

        $methodBody[] = new Stmt\Return_(new Expr\Variable('response'));

        return new Stmt\ClassMethod($name, [
            'type'     => Stmt\Class_::MODIFIER_PUBLIC,
            'params'   => $methodParameters,
            'stmts'    => $methodBody
        ], [
            'comments' => [new Comment\Doc(implode("\n", $documentation))]
        ]);
    }
} 
