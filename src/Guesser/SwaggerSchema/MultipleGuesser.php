<?php

namespace Joli\Jane\Swagger\Guesser\SwaggerSchema;

use Joli\Jane\Guesser\JsonSchema\MultipleGuesser as BaseMultipleGuesser;
use Joli\Jane\Swagger\Model\Schema;

class MultipleGuesser extends BaseMultipleGuesser
{
    /**
     * {@inheritDoc}
     */
    public function supportObject($object)
    {
        return ($object instanceof Schema) && is_array($object->getType());
    }
}
 