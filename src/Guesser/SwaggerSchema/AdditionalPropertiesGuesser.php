<?php

namespace Joli\Jane\Swagger\Guesser\SwaggerSchema;

use Joli\Jane\Guesser\JsonSchema\AdditionalPropertiesGuesser as BaseAdditionalPropertiesGuesser;
use Joli\Jane\Swagger\Model\Schema;

class AdditionalPropertiesGuesser extends BaseAdditionalPropertiesGuesser
{
    /**
     * {@inheritDoc}
     */
    public function supportObject($object)
    {
        if (!($object instanceof Schema)) {
            return false;
        }

        if ($object->getType() !== 'object') {
            return false;
        }

        if ($object->getAdditionalProperties() !== true && !is_object($object->getAdditionalProperties())) {
            return false;
        }

        return true;
    }
}
 