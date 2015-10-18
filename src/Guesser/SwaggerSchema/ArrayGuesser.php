<?php

namespace Joli\Jane\Swagger\Guesser\SwaggerSchema;

use Joli\Jane\Guesser\JsonSchema\ArrayGuesser as BaseArrayGuesser;
use Joli\Jane\Swagger\Model\Schema;

class ArrayGuesser extends BaseArrayGuesser
{
    /**
     * {@inheritDoc}
     */
    public function supportObject($object)
    {
        return (($object instanceof Schema) && $object->getType() === 'array');
    }
}
 