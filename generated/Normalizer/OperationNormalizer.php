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
            $values_61 = array();
            foreach ($data->{'tags'} as $value_62) {
                $values_61[] = $value_62;
            }
            $object->setTags($values_61);
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
            $values_63 = array();
            foreach ($data->{'produces'} as $value_64) {
                $values_63[] = $value_64;
            }
            $object->setProduces($values_63);
        }
        if (isset($data->{'consumes'})) {
            $values_65 = array();
            foreach ($data->{'consumes'} as $value_66) {
                $values_65[] = $value_66;
            }
            $object->setConsumes($values_65);
        }
        if (isset($data->{'parameters'})) {
            $values_67 = array();
            foreach ($data->{'parameters'} as $value_68) {
                $value_69 = $value_68;
                if (is_object($value_68) and isset($value_68->{'name'}) and (isset($value_68->{'in'}) and $value_68->{'in'} == 'body') and isset($value_68->{'schema'})) {
                    $value_69 = $this->serializer->deserialize($value_68, 'Joli\\Jane\\Swagger\\Model\\BodyParameter', 'raw', $context);
                }
                if (is_object($value_68) and (isset($value_68->{'in'}) and $value_68->{'in'} == 'header') and isset($value_68->{'name'}) and (isset($value_68->{'type'}) and ($value_68->{'type'} == 'string' or $value_68->{'type'} == 'number' or $value_68->{'type'} == 'boolean' or $value_68->{'type'} == 'integer' or $value_68->{'type'} == 'array'))) {
                    $value_69 = $this->serializer->deserialize($value_68, 'Joli\\Jane\\Swagger\\Model\\HeaderParameterSubSchema', 'raw', $context);
                }
                if (is_object($value_68) and (isset($value_68->{'in'}) and $value_68->{'in'} == 'formData') and isset($value_68->{'name'}) and (isset($value_68->{'type'}) and ($value_68->{'type'} == 'string' or $value_68->{'type'} == 'number' or $value_68->{'type'} == 'boolean' or $value_68->{'type'} == 'integer' or $value_68->{'type'} == 'array' or $value_68->{'type'} == 'file'))) {
                    $value_69 = $this->serializer->deserialize($value_68, 'Joli\\Jane\\Swagger\\Model\\FormDataParameterSubSchema', 'raw', $context);
                }
                if (is_object($value_68) and (isset($value_68->{'in'}) and $value_68->{'in'} == 'query') and isset($value_68->{'name'}) and (isset($value_68->{'type'}) and ($value_68->{'type'} == 'string' or $value_68->{'type'} == 'number' or $value_68->{'type'} == 'boolean' or $value_68->{'type'} == 'integer' or $value_68->{'type'} == 'array'))) {
                    $value_69 = $this->serializer->deserialize($value_68, 'Joli\\Jane\\Swagger\\Model\\QueryParameterSubSchema', 'raw', $context);
                }
                if (is_object($value_68) and (isset($value_68->{'in'}) and $value_68->{'in'} == 'path') and isset($value_68->{'name'}) and (isset($value_68->{'type'}) and ($value_68->{'type'} == 'string' or $value_68->{'type'} == 'number' or $value_68->{'type'} == 'boolean' or $value_68->{'type'} == 'integer' or $value_68->{'type'} == 'array'))) {
                    $value_69 = $this->serializer->deserialize($value_68, 'Joli\\Jane\\Swagger\\Model\\PathParameterSubSchema', 'raw', $context);
                }
                $values_67[] = $value_69;
            }
            $object->setParameters($values_67);
        }
        if (isset($data->{'responses'})) {
            $values_70 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'responses'} as $key_72 => $value_71) {
                if (preg_match('/^([0-9]{3})$|^(default)$/', $key_72) && (is_object($value_71) and isset($value_71->{'description'}))) {
                    $values_70[$key_72] = $this->serializer->deserialize($value_71, 'Joli\\Jane\\Swagger\\Model\\Response', 'raw', $context);
                    continue;
                }
                if (preg_match('/^x-/', $key_72) && isset($value_71)) {
                    $values_70[$key_72] = $value_71;
                    continue;
                }
            }
            $object->setResponses($values_70);
        }
        if (isset($data->{'schemes'})) {
            $values_73 = array();
            foreach ($data->{'schemes'} as $value_74) {
                $values_73[] = $value_74;
            }
            $object->setSchemes($values_73);
        }
        if (isset($data->{'deprecated'})) {
            $object->setDeprecated($data->{'deprecated'});
        }
        if (isset($data->{'security'})) {
            $values_75 = array();
            foreach ($data->{'security'} as $value_76) {
                $values_77 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
                foreach ($value_76 as $key_79 => $value_78) {
                    $values_80 = array();
                    foreach ($value_78 as $value_81) {
                        $values_80[] = $value_81;
                    }
                    $values_77[$key_79] = $values_80;
                }
                $values_75[] = $values_77;
            }
            $object->setSecurity($values_75);
        }

        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = new \stdClass();
        if (null !== $object->getTags()) {
            $values_82 = array();
            foreach ($object->getTags() as $value_83) {
                $values_82[] = $value_83;
            }
            $data->{'tags'} = $values_82;
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
            $values_84 = array();
            foreach ($object->getProduces() as $value_85) {
                $values_84[] = $value_85;
            }
            $data->{'produces'} = $values_84;
        }
        if (null !== $object->getConsumes()) {
            $values_86 = array();
            foreach ($object->getConsumes() as $value_87) {
                $values_86[] = $value_87;
            }
            $data->{'consumes'} = $values_86;
        }
        if (null !== $object->getParameters()) {
            $values_88 = array();
            foreach ($object->getParameters() as $value_89) {
                $value_90 = $value_89;
                if (is_object($value_89)) {
                    $value_90 = $this->serializer->serialize($value_89, 'raw', $context);
                }
                if (is_object($value_89)) {
                    $value_90 = $this->serializer->serialize($value_89, 'raw', $context);
                }
                if (is_object($value_89)) {
                    $value_90 = $this->serializer->serialize($value_89, 'raw', $context);
                }
                if (is_object($value_89)) {
                    $value_90 = $this->serializer->serialize($value_89, 'raw', $context);
                }
                if (is_object($value_89)) {
                    $value_90 = $this->serializer->serialize($value_89, 'raw', $context);
                }
                $values_88[] = $value_90;
            }
            $data->{'parameters'} = $values_88;
        }
        if (null !== $object->getResponses()) {
            $values_91 = new \stdClass();
            foreach ($object->getResponses() as $key_93 => $value_92) {
                if (preg_match('/^([0-9]{3})$|^(default)$/', $key_93) && is_object($value_92)) {
                    $values_91->{$key_93} = $this->serializer->serialize($value_92, 'raw', $context);
                    continue;
                }
                if (preg_match('/^x-/', $key_93) && !is_null($value_92)) {
                    $values_91->{$key_93} = $value_92;
                    continue;
                }
            }
            $data->{'responses'} = $values_91;
        }
        if (null !== $object->getSchemes()) {
            $values_94 = array();
            foreach ($object->getSchemes() as $value_95) {
                $values_94[] = $value_95;
            }
            $data->{'schemes'} = $values_94;
        }
        if (null !== $object->getDeprecated()) {
            $data->{'deprecated'} = $object->getDeprecated();
        }
        if (null !== $object->getSecurity()) {
            $values_96 = array();
            foreach ($object->getSecurity() as $value_97) {
                $values_98 = new \stdClass();
                foreach ($value_97 as $key_100 => $value_99) {
                    $values_101 = array();
                    foreach ($value_99 as $value_102) {
                        $values_101[] = $value_102;
                    }
                    $values_98->{$key_100} = $values_101;
                }
                $values_96[] = $values_98;
            }
            $data->{'security'} = $values_96;
        }

        return $data;
    }
}
