<?php

namespace Joli\Jane\OpenApi\Guesser\OpenApiSchema;

use Joli\Jane\Guesser\JsonSchema\ObjectGuesser;
use Joli\Jane\OpenApi\Model\Schema;
use \Joli\Jane\Registry;

class SchemaGuesser extends ObjectGuesser
{
    /**
     * {@inheritDoc}
     */
    public function supportObject($object)
    {
        return (($object instanceof Schema) && $object->getType() === 'object' && $object->getProperties() !== null);
    }

    /**
     * @return string
     */
    protected function getSchemaClass()
    {
        return Schema::class;
    }

    /**
     * {@inheritdoc}
     */
    public function guessClass($object, $name, $reference, Registry $registry)
    {
        return parent::guessClass($object, $this->cleanClassName($name), $reference, $registry);
    }

    /**
     * Clean a class name (remove swagger special chars and manage case)
     * @param string $name
     * @return string
     */
    protected function cleanClassName($name)
    {
        return preg_replace_callback('#[/\{\}]+(\w)#', function ($matches) {
            return ucfirst($matches[1]);
        }, $name);
    }
}
