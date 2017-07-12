<?php

namespace Joli\Jane\OpenApi\Generator;

use Joli\Jane\Generator\Context\Context;
use Joli\Jane\Runtime\Reference;
use Joli\Jane\Reference\Resolver;
use Joli\Jane\OpenApi\Model\Schema;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr;
use PhpParser\Node\Stmt;
use PhpParser\Node\Scalar;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

trait OutputGeneratorTrait
{
    /**
     * @return DenormalizerInterface
     */
    abstract protected function getDenormalizer();

    /**
     * @param         $status
     * @param         $schema
     * @param Context $context
     *
     * @return [string, null|Stmt\If_]
     */
    protected function createResponseDenormalizationStatement($status, $schema, Context $context)
    {
        $resolvedSchema = null;
        $reference      = null;
        $array          = false;

        if ($schema instanceof Reference) {
            list($reference, $resolvedSchema) = $this->resolve($schema, Schema::class);
        }

        if ($schema instanceof Schema && $schema->getType() == "array" && $schema->getItems() instanceof Reference) {
            list($reference, $resolvedSchema) = $this->resolve($schema->getItems(), Schema::class);
            $array = true;
        }

        if ($resolvedSchema === null) {
            return [null, null];
        }

        $class = $context->getRegistry()->getClass($reference);

        // Happens when reference resolve to a none object
        if ($class === null) {
            return [null, null];
        }

        $class = $context->getRegistry()->getSchema($reference)->getNamespace() . "\\Model\\" . $class->getName();

        if ($array) {
            $class .= "[]";
        }

        return ["\\" . $class, new Stmt\If_(
            new Expr\BinaryOp\Equal(
                new Scalar\String_($status),
                new Expr\MethodCall(new Expr\Variable('response'), 'getStatusCode')
            ),
            [
                'stmts' => [
                    new Stmt\Return_(new Expr\MethodCall(
                        new Expr\PropertyFetch(new Expr\Variable('this'), 'serializer'),
                        'deserialize',
                        [
                            new Arg(new Expr\Cast\String_(new Expr\MethodCall(new Expr\Variable('response'), 'getBody'))),
                            new Arg(new Scalar\String_($class)),
                            new Arg(new Scalar\String_('json'))
                        ]
                    ))
                ]
            ]
        )];
    }

    /**
     * @param Reference $reference
     * @param $class
     *
     * @return mixed
     */
    private function resolve(Reference $reference, $class)
    {
        $result    = $reference;

        do {
            $refString = (string) $reference->getMergedUri();
            $result = $result->resolve(function ($data) use($result, $class) {
                return $this->getDenormalizer()->denormalize($data, $class, 'json', [
                    'document-origin' => (string) $result->getMergedUri()->withFragment('')
                ]);
            });
        } while ($result instanceof Reference);

        return [$refString, $result];
    }
}
