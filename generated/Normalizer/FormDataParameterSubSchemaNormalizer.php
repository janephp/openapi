<?php

namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class FormDataParameterSubSchemaNormalizer implements DenormalizerInterface
{
    public $normalizerChain;
    public function setNormalizerChain(NormalizerChain $normalizerChain)
    {
        $this->normalizerChain = $normalizerChain;
    }
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\Swagger\\Model\\FormDataParameterSubSchema') {
            return false;
        }
        if ($format !== 'json') {
            return false;
        }

        return true;
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (empty($data)) {
            return null;
        }
        if (isset($data->{'$ref'})) {
            return new Reference($data->{'$ref'}, $context['rootSchema'] ?: null);
        }
        $object = new \Joli\Jane\Swagger\Model\FormDataParameterSubSchema();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (isset($data->{'required'})) {
            $object->setRequired($data->{'required'});
        }
        if (isset($data->{'in'})) {
            $object->setIn($data->{'in'});
        }
        if (isset($data->{'description'})) {
            $object->setDescription($data->{'description'});
        }
        if (isset($data->{'name'})) {
            $object->setName($data->{'name'});
        }
        if (isset($data->{'allowEmptyValue'})) {
            $object->setAllowEmptyValue($data->{'allowEmptyValue'});
        }
        if (isset($data->{'type'})) {
            $object->setType($data->{'type'});
        }
        if (isset($data->{'format'})) {
            $object->setFormat($data->{'format'});
        }
        if (isset($data->{'items'})) {
            $object->setItems($this->normalizerChain->denormalize($data->{'items'}, 'Joli\\Jane\\Swagger\\Model\\PrimitivesItems', 'json', $context));
        }
        if (isset($data->{'collectionFormat'})) {
            $object->setCollectionFormat($data->{'collectionFormat'});
        }
        if (isset($data->{'default'})) {
            $object->setDefault($data->{'default'});
        }
        if (isset($data->{'maximum'})) {
            $object->setMaximum($data->{'maximum'});
        }
        if (isset($data->{'exclusiveMaximum'})) {
            $object->setExclusiveMaximum($data->{'exclusiveMaximum'});
        }
        if (isset($data->{'minimum'})) {
            $object->setMinimum($data->{'minimum'});
        }
        if (isset($data->{'exclusiveMinimum'})) {
            $object->setExclusiveMinimum($data->{'exclusiveMinimum'});
        }
        if (isset($data->{'maxLength'})) {
            $object->setMaxLength($data->{'maxLength'});
        }
        if (isset($data->{'minLength'})) {
            $value_37 = $data->{'minLength'};
            if (is_int($data->{'minLength'})) {
                $value_37 = $data->{'minLength'};
            } elseif (isset($data->{'minLength'})) {
                $value_37 = $data->{'minLength'};
            }
            $object->setMinLength($value_37);
        }
        if (isset($data->{'pattern'})) {
            $object->setPattern($data->{'pattern'});
        }
        if (isset($data->{'maxItems'})) {
            $object->setMaxItems($data->{'maxItems'});
        }
        if (isset($data->{'minItems'})) {
            $value_38 = $data->{'minItems'};
            if (is_int($data->{'minItems'})) {
                $value_38 = $data->{'minItems'};
            } elseif (isset($data->{'minItems'})) {
                $value_38 = $data->{'minItems'};
            }
            $object->setMinItems($value_38);
        }
        if (isset($data->{'uniqueItems'})) {
            $object->setUniqueItems($data->{'uniqueItems'});
        }
        if (isset($data->{'enum'})) {
            $object->setEnum($data->{'enum'});
        }
        if (isset($data->{'multipleOf'})) {
            $object->setMultipleOf($data->{'multipleOf'});
        }

        return $object;
    }
}
