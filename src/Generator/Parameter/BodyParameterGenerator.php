<?php

namespace Joli\Jane\OpenApi\Generator\Parameter;

use Doctrine\Common\Inflector\Inflector;
use Joli\Jane\Generator\Context\Context;
use Joli\Jane\Runtime\Reference;
use Joli\Jane\Reference\Resolver;
use Joli\Jane\OpenApi\Model\BodyParameter;
use Joli\Jane\OpenApi\Model\Schema;
use PhpParser\Node;
use PhpParser\Parser;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class BodyParameterGenerator extends ParameterGenerator
{
    /**
     * @var DenormalizerInterface
     */
    private $denormalizer;

    public function __construct(Parser $parser, DenormalizerInterface $denormalizer)
    {
        parent::__construct($parser);

        $this->denormalizer = $denormalizer;
    }

    /**
     * {@inheritDoc}
     *
     * @param $parameter BodyParameter
     */
    public function generateMethodParameter($parameter, Context $context)
    {
        $name = Inflector::camelize($parameter->getName());

        list($class, $array) = $this->getClass($parameter, $context);

        if (null === $array || true === $array) {
            if ($class == "array") {
                return new Node\Param($name, null, "array");
            }

            return new Node\Param($name);
        }

        return new Node\Param($name, null, $class);
    }

    /**
     * {@inheritDoc}
     *
     * @param $parameter BodyParameter
     */
    public function generateDocParameter($parameter, Context $context)
    {
        list($class, $array) = $this->getClass($parameter, $context);

        if (null === $class) {
            return sprintf('%s $%s %s', 'mixed', Inflector::camelize($parameter->getName()), $parameter->getDescription() ?: '');
        }

        return sprintf('%s $%s %s', $class, Inflector::camelize($parameter->getName()), $parameter->getDescription() ?: '');
    }

    /**
     * @param BodyParameter $parameter
     * @param Context $context
     *
     * @return array
     */
    protected function getClass(BodyParameter $parameter, Context $context)
    {
        $resolvedSchema = null;
        $reference      = null;
        $array          = false;
        $schema         = $parameter->getSchema();

        if ($schema instanceof Reference) {
            list($reference, $resolvedSchema) = $this->resolveSchema($schema, Schema::class);
        }

        if ($schema instanceof Schema && $schema->getType() == "array" && $schema->getItems() instanceof Reference) {
            list($reference, $resolvedSchema) = $this->resolveSchema($schema->getItems(), Schema::class);
            $array          = true;
        }

        if ($resolvedSchema === null) {
            return [$schema->getType(), null];
        }

        $class = $context->getRegistry()->getClass($reference);
        $class = "\\" . $context->getRegistry()->getSchema($reference)->getNamespace() . "\\Model\\" . $class->getName();

        if ($array) {
            $class .= "[]";
        }

        return [$class, $array];
    }

    /**
     * @param Reference $reference
     * @param $class
     *
     * @return mixed
     */
    private function resolveSchema(Reference $reference, $class)
    {
        $result    = $reference;

        do {
            $refString = (string) $reference->getMergedUri();
            $result = $result->resolve(function ($data) use($result, $class) {
                return $this->denormalizer->denormalize($data, $class, 'json', [
                    'document-origin' => (string) $result->getMergedUri()->withFragment('')
                ]);
            });
        } while ($result instanceof Reference);

        return [$refString, $result];
    }
}
