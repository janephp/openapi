<?php

namespace Joli\Jane\Swagger\Tests\Expected\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class SchemaNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\Swagger\\Tests\\Expected\\Model\\Schema') {
            return false;
        }

        return true;
    }

    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \Joli\Jane\Swagger\Tests\Expected\Model\Schema) {
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
        $object = new \Joli\Jane\Swagger\Tests\Expected\Model\Schema();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (isset($data->{'stringProperty'})) {
            $object->setStringProperty($data->{'stringProperty'});
        }
        if (isset($data->{'integerProperty'})) {
            $object->setIntegerProperty($data->{'integerProperty'});
        }
        if (isset($data->{'floatProperty'})) {
            $object->setFloatProperty($data->{'floatProperty'});
        }
        if (isset($data->{'arrayProperty'})) {
            $values = [];
            foreach ($data->{'arrayProperty'} as $value) {
                $values[] = $value;
            }
            $object->setArrayProperty($values);
        }
        if (isset($data->{'mapProperty'})) {
            $values_0 = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'mapProperty'} as $key => $value_1) {
                $values_0[$key] = $value_1;
            }
            $object->setMapProperty($values_0);
        }
        if (isset($data->{'objectProperty'})) {
            $object->setObjectProperty($this->serializer->deserialize($data->{'objectProperty'}, 'Joli\\Jane\\Swagger\\Tests\\Expected\\Model\\ObjectProperty', 'raw', $context));
        }
        if (isset($data->{'objectRefProperty'})) {
            $object->setObjectRefProperty($this->serializer->deserialize($data->{'objectRefProperty'}, 'Joli\\Jane\\Swagger\\Tests\\Expected\\Model\\Schema', 'raw', $context));
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getStringProperty()) {
            $data->{'stringProperty'} = $object->getStringProperty();
        }
        if (null !== $object->getIntegerProperty()) {
            $data->{'integerProperty'} = $object->getIntegerProperty();
        }
        if (null !== $object->getFloatProperty()) {
            $data->{'floatProperty'} = $object->getFloatProperty();
        }
        if (null !== $object->getArrayProperty()) {
            $values_2 = [];
            foreach ($object->getArrayProperty() as $value_3) {
                $values_2[] = $value_3;
            }
            $data->{'arrayProperty'} = $values_2;
        }
        if (null !== $object->getMapProperty()) {
            $values_4 = new \stdClass();
            foreach ($object->getMapProperty() as $key_6 => $value_5) {
                $values_4->{$key_6} = $value_5;
            }
            $data->{'mapProperty'} = $values_4;
        }
        if (null !== $object->getObjectProperty()) {
            $data->{'objectProperty'} = $this->serializer->serialize($object->getObjectProperty(), 'raw', $context);
        }
        if (null !== $object->getObjectRefProperty()) {
            $data->{'objectRefProperty'} = $this->serializer->serialize($object->getObjectRefProperty(), 'raw', $context);
        }

        return $data;
    }
}
