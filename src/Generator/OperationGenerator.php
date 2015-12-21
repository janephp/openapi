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
use PhpParser\Node\Param;
use PhpParser\Node\Stmt;
use PhpParser\Node\Scalar;
use PhpParser\Comment;

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

    /**
     * @var Resolver
     */
    private $resolver;

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
        $methodParameters     = [];
        $documentation        = ['/**'];
        $bodyParameter        = null;
        $queryParamStatements = [];
        $replaceArgs          = [];
        $queryParamVariable   = new Expr\Variable('queryParam');
        $url                  = $operation->getPath();

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
                    $queryParamStatements = array_merge($queryParamStatements, $this->formDataParameterGenerator->generateQueryParamStatements($parameter, $queryParamVariable));
                }

                if ($parameter instanceof HeaderParameterSubSchema) {
                    $queryParamStatements = array_merge($queryParamStatements, $this->formDataParameterGenerator->generateQueryParamStatements($parameter, $queryParamVariable));
                }

                if ($parameter instanceof PathParameterSubSchema) {
                    $methodParameters[]   = $this->pathParameterGenerator->generateMethodParameter($parameter);
                    $documentation[]      = sprintf(' * @param %s', $this->pathParameterGenerator->generateDocParameter($parameter));
                    $replaceArgs[]        = new Arg(new Expr\Variable($parameter->getName()));
                    $url                  = str_replace('{'.$parameter->getName().'}', '%s', $url);
                }

                if ($parameter instanceof QueryParameterSubSchema) {
                    $queryParamStatements = array_merge($queryParamStatements, $this->queryParameterGenerator->generateQueryParamStatements($parameter, $queryParamVariable));
                }
            }
        }

        $methodParameters[] = new Param('parameters', new Expr\Array_());
        $methodParameters[] = new Param('fetch', new Expr\ConstFetch(new Name('self::FETCH_OBJECT')));

        $documentation[] = " * @param array  \$parameters List of parameters";
        $documentation[] = " * @param string \$fetch      Fetch mode (object or response)";
        $documentation[] = " *";
        $documentation[] = " * @return \\Psr\\Http\\Message\\ResponseInterface";
        $documentation[] = " */";

        $methodBody = [
            new Expr\Assign($queryParamVariable, new Expr\New_(new Name('QueryParam')))
        ];

        $methodBody = array_merge($methodBody, $queryParamStatements);
        $methodBody = array_merge($methodBody, [
            new Expr\Assign(new Expr\Variable('url'), new Expr\FuncCall(new Name('sprintf'), array_merge([
                new Arg(new Scalar\String_($url.'?%s'))
            ], array_merge($replaceArgs, [
                new Expr\MethodCall($queryParamVariable, 'buildQueryString', [new Arg(new Expr\Variable('parameters'))])
            ])))),
        ]);

        $methodBody = array_merge($methodBody, [
            new Expr\Assign(new Expr\Variable('request'), new Expr\MethodCall(
                new Expr\PropertyFetch(new Expr\Variable('this'), 'messageFactory'),
                'createRequest', [
                    new Arg(new Scalar\String_($operation->getMethod())),
                    new Arg(new Expr\Variable('url')),
                    new Arg(new Expr\MethodCall($queryParamVariable, 'buildHeaders', [new Arg(new Expr\Variable('parameters'))])),
                    new Arg($bodyParameter === null ? new Expr\ConstFetch(new Name('null')) : new Expr\Variable($bodyParameter->getName()))
                ]
            )),
            new Expr\Assign(new Expr\Variable('request'), new Expr\MethodCall(
                new Expr\Variable('request'),
                'withHeader', [
                    new Arg(new Scalar\String_('Host')),
                    new Arg(new Scalar\String_($operation->getHost()))
                ]
            )),
            new Expr\Assign(new Expr\Variable('response'), new Expr\MethodCall(
                new Expr\PropertyFetch(new Expr\Variable('this'), 'httpClient'),
                'sendRequest',
                [new Arg(new Expr\Variable('request'))]
            )),
            new Stmt\If_(
                new Expr\BinaryOp\Equal(new Expr\ConstFetch(new Name('self::FETCH_RESPONSE')), new Expr\Variable('fetch')), [
                    'stmts' => [
                        new Stmt\Return_(new Expr\Variable('response'))
                    ]
                ]
            ),
        ]);

        foreach ($operation->getOperation()->getResponses() as $status => $response) {
            $ifStatus = $this->createResponseDenormalizationStatement($status, $response->getSchema(), $context);

            if (null !== $ifStatus) {
                $methodBody[]   = $ifStatus;
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

    /**
     * @param         $status
     * @param         $schema
     * @param Context $context
     *
     * @return null|Stmt\If_
     */
    protected function createResponseDenormalizationStatement($status, $schema, Context $context)
    {
        $resolvedSchema = null;
        $array          = false;

        if ($schema instanceof Reference) {
            $resolvedSchema = $this->resolver->resolve($schema);
        }

        if ($schema instanceof Schema && $schema->getType() == "array" && $schema->getItems() instanceof Reference) {
            $resolvedSchema = $this->resolver->resolve($schema->getItems());
            $array          = true;
        }

        if ($resolvedSchema === null) {
            return null;
        }

        $class = $context->getObjectClassMap()[spl_object_hash($resolvedSchema)];
        $class = $context->getNamespace() . "\\Model\\" . $class->getName();

        if ($array) {
            $class .= "[]";
        }

        return new Stmt\If_(
            new Expr\BinaryOp\Equal(
                new Scalar\String_($status),
                new Expr\MethodCall(new Expr\Variable('response'), 'getStatusCode')
            ), [
                'stmts' => [
                    new Stmt\Return_(new Expr\MethodCall(
                        new Expr\PropertyFetch(new Expr\Variable('this'), 'serializer'),
                        'deserialize',
                        [
                            new Arg(new Expr\MethodCall(new Expr\MethodCall(new Expr\Variable('response'), 'getBody'), 'getContents')),
                            new Arg(new Scalar\String_($class)),
                            new Arg(new Scalar\String_('json'))
                        ]
                    ))
                ]
            ]
        );
    }
} 
