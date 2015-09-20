<?php

namespace Joli\Jane\Swagger\Guesser\SwaggerSchema;

use Joli\Jane\Guesser\JsonSchema\ObjectGuesser;
use Joli\Jane\Swagger\Model\Schema;

class SchemaGuesser extends ObjectGuesser
{
    /**
     * {@inheritDoc}
     */
    public function supportObject($object)
    {
        return (($object instanceof Schema) && $object->getType() === 'object' && $object->getProperties() !== null);
    }
}
 