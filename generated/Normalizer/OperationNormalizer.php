<?php

namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class OperationNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\Swagger\\Model\\Operation') {
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
        $object = new \Joli\Jane\Swagger\Model\Operation();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (isset($data->{'tags'})) {
            $values_29 = array();
            foreach ($data->{'tags'} as $value_30) {
                $values_29[] = $value_30;
            }
            $object->setTags($values_29);
        }
        if (isset($data->{'summary'})) {
            $object->setSummary($data->{'summary'});
        }
        if (isset($data->{'description'})) {
            $object->setDescription($data->{'description'});
        }
        if (isset($data->{'externalDocs'})) {
            $object->setExternalDocs($this->serializer->deserialize($data->{'externalDocs'}, 'Joli\\Jane\\Swagger\\Model\\ExternalDocs', 'raw', $context));
        }
        if (isset($data->{'operationId'})) {
            $object->setOperationId($data->{'operationId'});
        }
        if (isset($data->{'produces'})) {
            $values_31 = array();
            foreach ($data->{'produces'} as $value_32) {
                $values_31[] = $value_32;
            }
            $object->setProduces($values_31);
        }
        if (isset($data->{'consumes'})) {
            $values_33 = array();
            foreach ($data->{'consumes'} as $value_34) {
                $values_33[] = $value_34;
            }
            $object->setConsumes($values_33);
        }
        if (isset($data->{'parameters'})) {
            $values_35 = array();
            foreach ($data->{'parameters'} as $value_36) {
                $value_37 = $value_36;
                if (is_object($value_36) and isset($value_36->{'name'}) and (isset($value_36->{'in'}) and $value_36->{'in'} == 'body') and isset($value_36->{'schema'})) {
                    $value_37 = $this->serializer->deserialize($value_36, 'Joli\\Jane\\Swagger\\Model\\BodyParameter', 'raw', $context);
                }
                if (is_object($value_36) and (isset($value_36->{'in'}) and $value_36->{'in'} == 'header') and isset($value_36->{'name'}) and (isset($value_36->{'type'}) and ($value_36->{'type'} == 'string' or $value_36->{'type'} == 'number' or $value_36->{'type'} == 'boolean' or $value_36->{'type'} == 'integer' or $value_36->{'type'} == 'array'))) {
                    $value_37 = $this->serializer->deserialize($value_36, 'Joli\\Jane\\Swagger\\Model\\HeaderParameterSubSchema', 'raw', $context);
                }
                if (is_object($value_36) and (isset($value_36->{'in'}) and $value_36->{'in'} == 'formData') and isset($value_36->{'name'}) and (isset($value_36->{'type'}) and ($value_36->{'type'} == 'string' or $value_36->{'type'} == 'number' or $value_36->{'type'} == 'boolean' or $value_36->{'type'} == 'integer' or $value_36->{'type'} == 'array' or $value_36->{'type'} == 'file'))) {
                    $value_37 = $this->serializer->deserialize($value_36, 'Joli\\Jane\\Swagger\\Model\\FormDataParameterSubSchema', 'raw', $context);
                }
                if (is_object($value_36) and (isset($value_36->{'in'}) and $value_36->{'in'} == 'query') and isset($value_36->{'name'}) and (isset($value_36->{'type'}) and ($value_36->{'type'} == 'string' or $value_36->{'type'} == 'number' or $value_36->{'type'} == 'boolean' or $value_36->{'type'} == 'integer' or $value_36->{'type'} == 'array'))) {
                    $value_37 = $this->serializer->deserialize($value_36, 'Joli\\Jane\\Swagger\\Model\\QueryParameterSubSchema', 'raw', $context);
                }
                if (is_object($value_36) and (isset($value_36->{'in'}) and $value_36->{'in'} == 'path') and isset($value_36->{'name'}) and (isset($value_36->{'type'}) and ($value_36->{'type'} == 'string' or $value_36->{'type'} == 'number' or $value_36->{'type'} == 'boolean' or $value_36->{'type'} == 'integer' or $value_36->{'type'} == 'array'))) {
                    $value_37 = $this->serializer->deserialize($value_36, 'Joli\\Jane\\Swagger\\Model\\PathParameterSubSchema', 'raw', $context);
                }
                $values_35[] = $value_37;
            }
            $object->setParameters($values_35);
        }
        if (isset($data->{'responses'})) {
            $values_38 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'responses'} as $key_40 => $value_39) {
                if (preg_match('/^([0-9]{3})$|^(default)$/', $key_40) && (is_object($value_39) and isset($value_39->{'description'}))) {
                    $values_38[$key_40] = $this->serializer->deserialize($value_39, 'Joli\\Jane\\Swagger\\Model\\Response', 'raw', $context);
                    continue;
                }
                if (preg_match('/^x-/', $key_40) && isset($value_39)) {
                    $values_38[$key_40] = $value_39;
                    continue;
                }
            }
            $object->setResponses($values_38);
        }
        if (isset($data->{'schemes'})) {
            $values_41 = array();
            foreach ($data->{'schemes'} as $value_42) {
                $values_41[] = $value_42;
            }
            $object->setSchemes($values_41);
        }
        if (isset($data->{'deprecated'})) {
            $object->setDeprecated($data->{'deprecated'});
        }
        if (isset($data->{'security'})) {
            $values_43 = array();
            foreach ($data->{'security'} as $value_44) {
                $values_45 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
                foreach ($value_44 as $key_47 => $value_46) {
                    $values_48 = array();
                    foreach ($value_46 as $value_49) {
                        $values_48[] = $value_49;
                    }
                    $values_45[$key_47] = $values_48;
                }
                $values_43[] = $values_45;
            }
            $object->setSecurity($values_43);
        }

        return $object;
    }
}
