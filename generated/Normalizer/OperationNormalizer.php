<?php

namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class OperationNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\Swagger\\Model\\Operation') {
            return false;
        }

        return true;
    }
    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \Joli\Jane\Swagger\Model\Operation) {
            return true;
        }

        return false;
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
            $values_58 = array();
            foreach ($data->{'tags'} as $value_59) {
                $values_58[] = $value_59;
            }
            $object->setTags($values_58);
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
            $values_60 = array();
            foreach ($data->{'produces'} as $value_61) {
                $values_60[] = $value_61;
            }
            $object->setProduces($values_60);
        }
        if (isset($data->{'consumes'})) {
            $values_62 = array();
            foreach ($data->{'consumes'} as $value_63) {
                $values_62[] = $value_63;
            }
            $object->setConsumes($values_62);
        }
        if (isset($data->{'parameters'})) {
            $values_64 = array();
            foreach ($data->{'parameters'} as $value_65) {
                $value_66 = $value_65;
                if (is_object($value_65) and isset($value_65->{'name'}) and (isset($value_65->{'in'}) and $value_65->{'in'} == 'body') and isset($value_65->{'schema'})) {
                    $value_66 = $this->serializer->deserialize($value_65, 'Joli\\Jane\\Swagger\\Model\\BodyParameter', 'raw', $context);
                }
                if (is_object($value_65) and (isset($value_65->{'in'}) and $value_65->{'in'} == 'header') and isset($value_65->{'name'}) and (isset($value_65->{'type'}) and ($value_65->{'type'} == 'string' or $value_65->{'type'} == 'number' or $value_65->{'type'} == 'boolean' or $value_65->{'type'} == 'integer' or $value_65->{'type'} == 'array'))) {
                    $value_66 = $this->serializer->deserialize($value_65, 'Joli\\Jane\\Swagger\\Model\\HeaderParameterSubSchema', 'raw', $context);
                }
                if (is_object($value_65) and (isset($value_65->{'in'}) and $value_65->{'in'} == 'formData') and isset($value_65->{'name'}) and (isset($value_65->{'type'}) and ($value_65->{'type'} == 'string' or $value_65->{'type'} == 'number' or $value_65->{'type'} == 'boolean' or $value_65->{'type'} == 'integer' or $value_65->{'type'} == 'array' or $value_65->{'type'} == 'file'))) {
                    $value_66 = $this->serializer->deserialize($value_65, 'Joli\\Jane\\Swagger\\Model\\FormDataParameterSubSchema', 'raw', $context);
                }
                if (is_object($value_65) and (isset($value_65->{'in'}) and $value_65->{'in'} == 'query') and isset($value_65->{'name'}) and (isset($value_65->{'type'}) and ($value_65->{'type'} == 'string' or $value_65->{'type'} == 'number' or $value_65->{'type'} == 'boolean' or $value_65->{'type'} == 'integer' or $value_65->{'type'} == 'array'))) {
                    $value_66 = $this->serializer->deserialize($value_65, 'Joli\\Jane\\Swagger\\Model\\QueryParameterSubSchema', 'raw', $context);
                }
                if (is_object($value_65) and (isset($value_65->{'in'}) and $value_65->{'in'} == 'path') and isset($value_65->{'name'}) and (isset($value_65->{'type'}) and ($value_65->{'type'} == 'string' or $value_65->{'type'} == 'number' or $value_65->{'type'} == 'boolean' or $value_65->{'type'} == 'integer' or $value_65->{'type'} == 'array'))) {
                    $value_66 = $this->serializer->deserialize($value_65, 'Joli\\Jane\\Swagger\\Model\\PathParameterSubSchema', 'raw', $context);
                }
                $values_64[] = $value_66;
            }
            $object->setParameters($values_64);
        }
        if (isset($data->{'responses'})) {
            $values_67 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'responses'} as $key_69 => $value_68) {
                if (preg_match('/^([0-9]{3})$|^(default)$/', $key_69) && (is_object($value_68) and isset($value_68->{'description'}))) {
                    $values_67[$key_69] = $this->serializer->deserialize($value_68, 'Joli\\Jane\\Swagger\\Model\\Response', 'raw', $context);
                    continue;
                }
                if (preg_match('/^x-/', $key_69) && isset($value_68)) {
                    $values_67[$key_69] = $value_68;
                    continue;
                }
            }
            $object->setResponses($values_67);
        }
        if (isset($data->{'schemes'})) {
            $values_70 = array();
            foreach ($data->{'schemes'} as $value_71) {
                $values_70[] = $value_71;
            }
            $object->setSchemes($values_70);
        }
        if (isset($data->{'deprecated'})) {
            $object->setDeprecated($data->{'deprecated'});
        }
        if (isset($data->{'security'})) {
            $values_72 = array();
            foreach ($data->{'security'} as $value_73) {
                $values_74 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
                foreach ($value_73 as $key_76 => $value_75) {
                    $values_77 = array();
                    foreach ($value_75 as $value_78) {
                        $values_77[] = $value_78;
                    }
                    $values_74[$key_76] = $values_77;
                }
                $values_72[] = $values_74;
            }
            $object->setSecurity($values_72);
        }

        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = new \stdClass();
        if (null !== $object->getTags()) {
            $values_79 = array();
            foreach ($object->getTags() as $value_80) {
                $values_79[] = $value_80;
            }
            $data->{'tags'} = $values_79;
        }
        if (null !== $object->getSummary()) {
            $data->{'summary'} = $object->getSummary();
        }
        if (null !== $object->getDescription()) {
            $data->{'description'} = $object->getDescription();
        }
        if (null !== $object->getExternalDocs()) {
            $data->{'externalDocs'} = $this->serializer->serialize($object->getExternalDocs(), 'raw', $context);
        }
        if (null !== $object->getOperationId()) {
            $data->{'operationId'} = $object->getOperationId();
        }
        if (null !== $object->getProduces()) {
            $values_81 = array();
            foreach ($object->getProduces() as $value_82) {
                $values_81[] = $value_82;
            }
            $data->{'produces'} = $values_81;
        }
        if (null !== $object->getConsumes()) {
            $values_83 = array();
            foreach ($object->getConsumes() as $value_84) {
                $values_83[] = $value_84;
            }
            $data->{'consumes'} = $values_83;
        }
        if (null !== $object->getParameters()) {
            $values_85 = array();
            foreach ($object->getParameters() as $value_86) {
                $value_87 = $value_86;
                if (is_object($value_86)) {
                    $value_87 = $this->serializer->serialize($value_86, 'raw', $context);
                }
                if (is_object($value_86)) {
                    $value_87 = $this->serializer->serialize($value_86, 'raw', $context);
                }
                if (is_object($value_86)) {
                    $value_87 = $this->serializer->serialize($value_86, 'raw', $context);
                }
                if (is_object($value_86)) {
                    $value_87 = $this->serializer->serialize($value_86, 'raw', $context);
                }
                if (is_object($value_86)) {
                    $value_87 = $this->serializer->serialize($value_86, 'raw', $context);
                }
                $values_85[] = $value_87;
            }
            $data->{'parameters'} = $values_85;
        }
        if (null !== $object->getResponses()) {
            $data->{'responses'} = $object->getResponses();
        }
        if (null !== $object->getSchemes()) {
            $values_88 = array();
            foreach ($object->getSchemes() as $value_89) {
                $values_88[] = $value_89;
            }
            $data->{'schemes'} = $values_88;
        }
        if (null !== $object->getDeprecated()) {
            $data->{'deprecated'} = $object->getDeprecated();
        }
        if (null !== $object->getSecurity()) {
            $values_90 = array();
            foreach ($object->getSecurity() as $value_91) {
                $values_92 = new \stdClass();
                foreach ($value_91 as $key_94 => $value_93) {
                    $values_95 = array();
                    foreach ($value_93 as $value_96) {
                        $values_95[] = $value_96;
                    }
                    $values_92->{$key_94} = $values_95;
                }
                $values_90[] = $values_92;
            }
            $data->{'security'} = $values_90;
        }

        return $data;
    }
}
