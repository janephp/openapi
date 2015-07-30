<?php

namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class OperationNormalizer implements DenormalizerInterface
{
    public $normalizerChain;
    public function setNormalizerChain(NormalizerChain $normalizerChain)
    {
        $this->normalizerChain = $normalizerChain;
    }
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\Swagger\\Model\\Operation') {
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
        $object = new \Joli\Jane\Swagger\Model\Operation();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (isset($data->{'tags'})) {
            $values_6 = array();
            foreach ($data->{'tags'} as $value_7) {
                $values_6[] = $value_7;
            }
            $object->setTags($values_6);
        }
        if (isset($data->{'summary'})) {
            $object->setSummary($data->{'summary'});
        }
        if (isset($data->{'description'})) {
            $object->setDescription($data->{'description'});
        }
        if (isset($data->{'externalDocs'})) {
            $object->setExternalDocs($this->normalizerChain->denormalize($data->{'externalDocs'}, 'Joli\\Jane\\Swagger\\Model\\ExternalDocs', 'json', $context));
        }
        if (isset($data->{'operationId'})) {
            $object->setOperationId($data->{'operationId'});
        }
        if (isset($data->{'produces'})) {
            $values_8 = array();
            foreach ($data->{'produces'} as $value_9) {
                $values_8[] = $value_9;
            }
            $object->setProduces($values_8);
        }
        if (isset($data->{'consumes'})) {
            $values_10 = array();
            foreach ($data->{'consumes'} as $value_11) {
                $values_10[] = $value_11;
            }
            $object->setConsumes($values_10);
        }
        if (isset($data->{'parameters'})) {
            $values_12 = array();
            foreach ($data->{'parameters'} as $value_13) {
                $value_14 = $value_13;
                if (is_object($value_13) and $value_13->{'in'} == 'body') {
                    $value_14 = $this->normalizerChain->denormalize($value_13, 'Joli\\Jane\\Swagger\\Model\\BodyParameter', 'json', $context);
                } elseif (isset($value_13)) {
                    $value_32 = $value_13;
                    if (is_object($value_13) and $value_13->{'in'} == 'header' and ($value_13->{'type'} == 'string' or $value_13->{'type'} == 'number' or $value_13->{'type'} == 'boolean' or $value_13->{'type'} == 'integer' or $value_13->{'type'} == 'array')) {
                        $value_32 = $this->normalizerChain->denormalize($value_13, 'Joli\\Jane\\Swagger\\Model\\HeaderParameterSubSchema', 'json', $context);
                    } elseif (is_object($value_13) and $value_13->{'in'} == 'formData' and ($value_13->{'type'} == 'string' or $value_13->{'type'} == 'number' or $value_13->{'type'} == 'boolean' or $value_13->{'type'} == 'integer' or $value_13->{'type'} == 'array' or $value_13->{'type'} == 'file')) {
                        $value_32 = $this->normalizerChain->denormalize($value_13, 'Joli\\Jane\\Swagger\\Model\\FormDataParameterSubSchema', 'json', $context);
                    } elseif (is_object($value_13) and $value_13->{'in'} == 'query' and ($value_13->{'type'} == 'string' or $value_13->{'type'} == 'number' or $value_13->{'type'} == 'boolean' or $value_13->{'type'} == 'integer' or $value_13->{'type'} == 'array')) {
                        $value_32 = $this->normalizerChain->denormalize($value_13, 'Joli\\Jane\\Swagger\\Model\\QueryParameterSubSchema', 'json', $context);
                    } elseif (is_object($value_13) and $value_13->{'in'} == 'path' and ($value_13->{'type'} == 'string' or $value_13->{'type'} == 'number' or $value_13->{'type'} == 'boolean' or $value_13->{'type'} == 'integer' or $value_13->{'type'} == 'array')) {
                        $value_32 = $this->normalizerChain->denormalize($value_13, 'Joli\\Jane\\Swagger\\Model\\PathParameterSubSchema', 'json', $context);
                    }
                    $value_14 = $value_32;
                }
                $values_12[] = $value_14;
            }
            $object->setParameters($values_12);
        }
        if (isset($data->{'responses'})) {
            $values_43 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'responses'} as $key_44 => $value_45) {
                if (preg_match('/^([0-9]{3})$|^(default)$/', $key_44)) {
                    $values_43[$key_44] = $this->normalizerChain->denormalize($value_45, 'Joli\\Jane\\Swagger\\Model\\Response', 'json', $context);
                    continue;
                }
                if (preg_match('/^x-/', $key_44)) {
                    $values_43[$key_44] = $value_45;
                    continue;
                }
            }
            $object->setResponses($values_43);
        }
        if (isset($data->{'schemes'})) {
            $values_54 = array();
            foreach ($data->{'schemes'} as $value_55) {
                $values_54[] = $value_55;
            }
            $object->setSchemes($values_54);
        }
        if (isset($data->{'deprecated'})) {
            $object->setDeprecated($data->{'deprecated'});
        }
        if (isset($data->{'security'})) {
            $values_56 = array();
            foreach ($data->{'security'} as $value_57) {
                $values_58 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
                foreach ($value_57 as $key_59 => $value_60) {
                    $values_61 = array();
                    foreach ($value_60 as $value_62) {
                        $values_61[] = $value_62;
                    }
                    $values_58[$key_59] = $values_61;
                }
                $values_56[] = $values_58;
            }
            $object->setSecurity($values_56);
        }

        return $object;
    }
}
