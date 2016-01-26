<?php

namespace Joli\Jane\OpenApi\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class OperationNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\OpenApi\\Model\\Operation') {
            return false;
        }

        return true;
    }

    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \Joli\Jane\OpenApi\Model\Operation) {
            return true;
        }

        return false;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (empty($data)) {
            return null;
        }
        if (isset($data->{'$ref'})) {
            return new Reference($data->{'$ref'}, $context['rootSchema'] ?: null);
        }
        $object = new \Joli\Jane\OpenApi\Model\Operation();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (isset($data->{'tags'})) {
            $values_61 = [];
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
            $object->setExternalDocs($this->serializer->deserialize($data->{'externalDocs'}, 'Joli\\Jane\\OpenApi\\Model\\ExternalDocs', 'raw', $context));
        }
        if (isset($data->{'operationId'})) {
            $object->setOperationId($data->{'operationId'});
        }
        if (isset($data->{'produces'})) {
            $values_63 = [];
            foreach ($data->{'produces'} as $value_64) {
                $values_63[] = $value_64;
            }
            $object->setProduces($values_63);
        }
        if (isset($data->{'consumes'})) {
            $values_65 = [];
            foreach ($data->{'consumes'} as $value_66) {
                $values_65[] = $value_66;
            }
            $object->setConsumes($values_65);
        }
        if (isset($data->{'parameters'})) {
            $values_67 = [];
            foreach ($data->{'parameters'} as $value_68) {
                $value_69 = $value_68;
                if (is_object($value_68) and isset($value_68->{'name'}) and (isset($value_68->{'in'}) and $value_68->{'in'} == 'body') and isset($value_68->{'schema'})) {
                    $value_69 = $this->serializer->deserialize($value_68, 'Joli\\Jane\\OpenApi\\Model\\BodyParameter', 'raw', $context);
                }
                if (is_object($value_68) and (isset($value_68->{'in'}) and $value_68->{'in'} == 'header') and isset($value_68->{'name'}) and (isset($value_68->{'type'}) and ($value_68->{'type'} == 'string' or $value_68->{'type'} == 'number' or $value_68->{'type'} == 'boolean' or $value_68->{'type'} == 'integer' or $value_68->{'type'} == 'array'))) {
                    $value_69 = $this->serializer->deserialize($value_68, 'Joli\\Jane\\OpenApi\\Model\\HeaderParameterSubSchema', 'raw', $context);
                }
                if (is_object($value_68) and (isset($value_68->{'in'}) and $value_68->{'in'} == 'formData') and isset($value_68->{'name'}) and (isset($value_68->{'type'}) and ($value_68->{'type'} == 'string' or $value_68->{'type'} == 'number' or $value_68->{'type'} == 'boolean' or $value_68->{'type'} == 'integer' or $value_68->{'type'} == 'array' or $value_68->{'type'} == 'file'))) {
                    $value_69 = $this->serializer->deserialize($value_68, 'Joli\\Jane\\OpenApi\\Model\\FormDataParameterSubSchema', 'raw', $context);
                }
                if (is_object($value_68) and (isset($value_68->{'in'}) and $value_68->{'in'} == 'query') and isset($value_68->{'name'}) and (isset($value_68->{'type'}) and ($value_68->{'type'} == 'string' or $value_68->{'type'} == 'number' or $value_68->{'type'} == 'boolean' or $value_68->{'type'} == 'integer' or $value_68->{'type'} == 'array'))) {
                    $value_69 = $this->serializer->deserialize($value_68, 'Joli\\Jane\\OpenApi\\Model\\QueryParameterSubSchema', 'raw', $context);
                }
                if (is_object($value_68) and (isset($value_68->{'required'}) and $value_68->{'required'} == '1') and (isset($value_68->{'in'}) and $value_68->{'in'} == 'path') and isset($value_68->{'name'}) and (isset($value_68->{'type'}) and ($value_68->{'type'} == 'string' or $value_68->{'type'} == 'number' or $value_68->{'type'} == 'boolean' or $value_68->{'type'} == 'integer' or $value_68->{'type'} == 'array'))) {
                    $value_69 = $this->serializer->deserialize($value_68, 'Joli\\Jane\\OpenApi\\Model\\PathParameterSubSchema', 'raw', $context);
                }
                if (is_object($value_68) and isset($value_68->{'$ref'})) {
                    $value_69 = $this->serializer->deserialize($value_68, 'Joli\\Jane\\OpenApi\\Model\\JsonReference', 'raw', $context);
                }
                $values_67[] = $value_69;
            }
            $object->setParameters($values_67);
        }
        if (isset($data->{'responses'})) {
            $values_70 = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'responses'} as $key_72 => $value_71) {
                if (preg_match('/^([0-9]{3})$|^(default)$/', $key_72) && isset($value_71)) {
                    $value_73 = $value_71;
                    if (is_object($value_71) and isset($value_71->{'description'})) {
                        $value_73 = $this->serializer->deserialize($value_71, 'Joli\\Jane\\OpenApi\\Model\\Response', 'raw', $context);
                    }
                    if (is_object($value_71) and isset($value_71->{'$ref'})) {
                        $value_73 = $this->serializer->deserialize($value_71, 'Joli\\Jane\\OpenApi\\Model\\JsonReference', 'raw', $context);
                    }
                    $values_70[$key_72] = $value_73;
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
            $values_74 = [];
            foreach ($data->{'schemes'} as $value_75) {
                $values_74[] = $value_75;
            }
            $object->setSchemes($values_74);
        }
        if (isset($data->{'deprecated'})) {
            $object->setDeprecated($data->{'deprecated'});
        }
        if (isset($data->{'security'})) {
            $values_76 = [];
            foreach ($data->{'security'} as $value_77) {
                $values_78 = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($value_77 as $key_80 => $value_79) {
                    $values_81 = [];
                    foreach ($value_79 as $value_82) {
                        $values_81[] = $value_82;
                    }
                    $values_78[$key_80] = $values_81;
                }
                $values_76[] = $values_78;
            }
            $object->setSecurity($values_76);
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getTags()) {
            $values_83 = [];
            foreach ($object->getTags() as $value_84) {
                $values_83[] = $value_84;
            }
            $data->{'tags'} = $values_83;
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
            $values_85 = [];
            foreach ($object->getProduces() as $value_86) {
                $values_85[] = $value_86;
            }
            $data->{'produces'} = $values_85;
        }
        if (null !== $object->getConsumes()) {
            $values_87 = [];
            foreach ($object->getConsumes() as $value_88) {
                $values_87[] = $value_88;
            }
            $data->{'consumes'} = $values_87;
        }
        if (null !== $object->getParameters()) {
            $values_89 = [];
            foreach ($object->getParameters() as $value_90) {
                $value_91 = $value_90;
                if (is_object($value_90)) {
                    $value_91 = $this->serializer->serialize($value_90, 'raw', $context);
                }
                if (is_object($value_90)) {
                    $value_91 = $this->serializer->serialize($value_90, 'raw', $context);
                }
                if (is_object($value_90)) {
                    $value_91 = $this->serializer->serialize($value_90, 'raw', $context);
                }
                if (is_object($value_90)) {
                    $value_91 = $this->serializer->serialize($value_90, 'raw', $context);
                }
                if (is_object($value_90)) {
                    $value_91 = $this->serializer->serialize($value_90, 'raw', $context);
                }
                if (is_object($value_90)) {
                    $value_91 = $this->serializer->serialize($value_90, 'raw', $context);
                }
                $values_89[] = $value_91;
            }
            $data->{'parameters'} = $values_89;
        }
        if (null !== $object->getResponses()) {
            $values_92 = new \stdClass();
            foreach ($object->getResponses() as $key_94 => $value_93) {
                if (preg_match('/^([0-9]{3})$|^(default)$/', $key_94) && !is_null($value_93)) {
                    $value_95 = $value_93;
                    if (is_object($value_93)) {
                        $value_95 = $this->serializer->serialize($value_93, 'raw', $context);
                    }
                    if (is_object($value_93)) {
                        $value_95 = $this->serializer->serialize($value_93, 'raw', $context);
                    }
                    $values_92->{$key_94} = $value_95;
                    continue;
                }
                if (preg_match('/^x-/', $key_94) && !is_null($value_93)) {
                    $values_92->{$key_94} = $value_93;
                    continue;
                }
            }
            $data->{'responses'} = $values_92;
        }
        if (null !== $object->getSchemes()) {
            $values_96 = [];
            foreach ($object->getSchemes() as $value_97) {
                $values_96[] = $value_97;
            }
            $data->{'schemes'} = $values_96;
        }
        if (null !== $object->getDeprecated()) {
            $data->{'deprecated'} = $object->getDeprecated();
        }
        if (null !== $object->getSecurity()) {
            $values_98 = [];
            foreach ($object->getSecurity() as $value_99) {
                $values_100 = new \stdClass();
                foreach ($value_99 as $key_102 => $value_101) {
                    $values_103 = [];
                    foreach ($value_101 as $value_104) {
                        $values_103[] = $value_104;
                    }
                    $values_100->{$key_102} = $values_103;
                }
                $values_98[] = $values_100;
            }
            $data->{'security'} = $values_98;
        }

        return $data;
    }
}
