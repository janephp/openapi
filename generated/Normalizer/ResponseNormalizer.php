<?php

namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class ResponseNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\Swagger\\Model\\Response') {
            return false;
        }

        return true;
    }
    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \Joli\Jane\Swagger\Model\Response) {
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
        $object = new \Joli\Jane\Swagger\Model\Response();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (isset($data->{'description'})) {
            $object->setDescription($data->{'description'});
        }
        if (isset($data->{'schema'})) {
            $object->setSchema($this->serializer->deserialize($data->{'schema'}, 'Joli\\Jane\\Swagger\\Model\\Schema', 'raw', $context));
        }
        if (isset($data->{'headers'})) {
            $values_109 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'headers'} as $key_111 => $value_110) {
                $values_109[$key_111] = $this->serializer->deserialize($value_110, 'Joli\\Jane\\Swagger\\Model\\Header', 'raw', $context);
            }
            $object->setHeaders($values_109);
        }
        if (isset($data->{'examples'})) {
            $values_112 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'examples'} as $key_114 => $value_113) {
                if (preg_match('/^[a-z0-9-]+\/[a-z0-9\-+]+$/', $key_114) && isset($value_113)) {
                    $values_112[$key_114] = $value_113;
                    continue;
                }
            }
            $object->setExamples($values_112);
        }

        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = new \stdClass();
        if (null !== $object->getDescription()) {
            $data->{'description'} = $object->getDescription();
        }
        if (null !== $object->getSchema()) {
            $data->{'schema'} = $this->serializer->serialize($object->getSchema(), 'raw', $context);
        }
        if (null !== $object->getHeaders()) {
            $values_115 = new \stdClass();
            foreach ($object->getHeaders() as $key_117 => $value_116) {
                $values_115->{$key_117} = $this->serializer->serialize($value_116, 'raw', $context);
            }
            $data->{'headers'} = $values_115;
        }
        if (null !== $object->getExamples()) {
            $values_118 = new \stdClass();
            foreach ($object->getExamples() as $key_120 => $value_119) {
                if (preg_match('/^[a-z0-9-]+\/[a-z0-9\-+]+$/', $key_120) && !is_null($value_119)) {
                    $values_118->{$key_120} = $value_119;
                    continue;
                }
            }
            $data->{'examples'} = $values_118;
        }

        return $data;
    }
}
