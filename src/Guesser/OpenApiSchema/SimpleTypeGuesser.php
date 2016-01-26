<?php

namespace Joli\Jane\OpenApi\Guesser\OpenApiSchema;

use Joli\Jane\Guesser\JsonSchema\SimpleTypeGuesser as BaseSimpleTypeGuesser;
use Joli\Jane\OpenApi\Model\Schema;

class SimpleTypeGuesser extends BaseSimpleTypeGuesser
{
    /**
     * {@inheritDoc}
     */
    public function supportObject($object)
    {
        return ($object instanceof Schema) && in_array($object->getType(), $this->typesSupported);
    }
}
