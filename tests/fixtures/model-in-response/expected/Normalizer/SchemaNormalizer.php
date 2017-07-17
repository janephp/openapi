<?php

namespace Joli\Jane\OpenApi\Tests\Expected\Normalizer;

use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SchemaNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\OpenApi\\Tests\\Expected\\Model\\Schema') {
            return false;
        }

        return true;
    }

    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \Joli\Jane\OpenApi\Tests\Expected\Model\Schema) {
            return true;
        }

        return false;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (!is_object($data)) {
            throw new InvalidArgumentException();
        }
        $object = new \Joli\Jane\OpenApi\Tests\Expected\Model\Schema();
        if (property_exists($data, 'stringProperty')) {
            $object->setStringProperty($data->{'stringProperty'});
        }
        if (property_exists($data, 'integerProperty')) {
            $object->setIntegerProperty($data->{'integerProperty'});
        }
        if (property_exists($data, 'floatProperty')) {
            $object->setFloatProperty($data->{'floatProperty'});
        }
        if (property_exists($data, 'arrayProperty')) {
            $values = [];
            foreach ($data->{'arrayProperty'} as $value) {
                $values[] = $value;
            }
            $object->setArrayProperty($values);
        }
        if (property_exists($data, 'mapProperty')) {
            $values_1 = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'mapProperty'} as $key => $value_1) {
                $values_1[$key] = $value_1;
            }
            $object->setMapProperty($values_1);
        }
        if (property_exists($data, 'objectProperty')) {
            $object->setObjectProperty($this->denormalizer->denormalize($data->{'objectProperty'}, 'Joli\\Jane\\OpenApi\\Tests\\Expected\\Model\\SchemaobjectProperty', 'json', $context));
        }
        if (property_exists($data, 'objectRefProperty')) {
            $object->setObjectRefProperty($this->denormalizer->denormalize($data->{'objectRefProperty'}, 'Joli\\Jane\\OpenApi\\Tests\\Expected\\Model\\Schema', 'json', $context));
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
            $values = [];
            foreach ($object->getArrayProperty() as $value) {
                $values[] = $value;
            }
            $data->{'arrayProperty'} = $values;
        }
        if (null !== $object->getMapProperty()) {
            $values_1 = new \stdClass();
            foreach ($object->getMapProperty() as $key => $value_1) {
                $values_1->{$key} = $value_1;
            }
            $data->{'mapProperty'} = $values_1;
        }
        if (null !== $object->getObjectProperty()) {
            $data->{'objectProperty'} = $this->normalizer->normalize($object->getObjectProperty(), 'json', $context);
        }
        if (null !== $object->getObjectRefProperty()) {
            $data->{'objectRefProperty'} = $this->normalizer->normalize($object->getObjectRefProperty(), 'json', $context);
        }

        return $data;
    }
}
