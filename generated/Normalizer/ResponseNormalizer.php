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

    public function denormalize($data, $class, $format = null, array $context = [])
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
            $value_111 = $data->{'schema'};
            if (is_object($data->{'schema'})) {
                $value_111 = $this->serializer->deserialize($data->{'schema'}, 'Joli\\Jane\\Swagger\\Model\\Schema', 'raw', $context);
            }
            if (is_object($data->{'schema'}) and (isset($data->{'schema'}->{'type'}) and $data->{'schema'}->{'type'} == 'file')) {
                $value_111 = $this->serializer->deserialize($data->{'schema'}, 'Joli\\Jane\\Swagger\\Model\\FileSchema', 'raw', $context);
            }
            $object->setSchema($value_111);
        }
        if (isset($data->{'headers'})) {
            $values_112 = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'headers'} as $key_114 => $value_113) {
                $values_112[$key_114] = $this->serializer->deserialize($value_113, 'Joli\\Jane\\Swagger\\Model\\Header', 'raw', $context);
            }
            $object->setHeaders($values_112);
        }
        if (isset($data->{'examples'})) {
            $values_115 = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'examples'} as $key_117 => $value_116) {
                $values_115[$key_117] = $value_116;
            }
            $object->setExamples($values_115);
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getDescription()) {
            $data->{'description'} = $object->getDescription();
        }
        if (null !== $object->getSchema()) {
            $value_118 = $object->getSchema();
            if (is_object($object->getSchema())) {
                $value_118 = $this->serializer->serialize($object->getSchema(), 'raw', $context);
            }
            if (is_object($object->getSchema())) {
                $value_118 = $this->serializer->serialize($object->getSchema(), 'raw', $context);
            }
            $data->{'schema'} = $value_118;
        }
        if (null !== $object->getHeaders()) {
            $values_119 = new \stdClass();
            foreach ($object->getHeaders() as $key_121 => $value_120) {
                $values_119->{$key_121} = $this->serializer->serialize($value_120, 'raw', $context);
            }
            $data->{'headers'} = $values_119;
        }
        if (null !== $object->getExamples()) {
            $values_122 = new \stdClass();
            foreach ($object->getExamples() as $key_124 => $value_123) {
                $values_122->{$key_124} = $value_123;
            }
            $data->{'examples'} = $values_122;
        }

        return $data;
    }
}
