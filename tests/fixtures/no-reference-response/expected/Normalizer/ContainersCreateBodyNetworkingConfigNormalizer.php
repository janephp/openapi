<?php

namespace Joli\Jane\OpenApi\Tests\Expected\Normalizer;

use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ContainersCreateBodyNetworkingConfigNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\OpenApi\\Tests\\Expected\\Model\\ContainersCreateBodyNetworkingConfig') {
            return false;
        }

        return true;
    }

    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \Joli\Jane\OpenApi\Tests\Expected\Model\ContainersCreateBodyNetworkingConfig) {
            return true;
        }

        return false;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (!is_object($data)) {
            throw new InvalidArgumentException();
        }
        $object = new \Joli\Jane\OpenApi\Tests\Expected\Model\ContainersCreateBodyNetworkingConfig();
        if (property_exists($data, 'EndpointsConfig')) {
            $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'EndpointsConfig'} as $key => $value) {
                $values[$key] = $this->denormalizer->denormalize($value, 'Joli\\Jane\\OpenApi\\Tests\\Expected\\Model\\EndpointSettings', 'json', $context);
            }
            $object->setEndpointsConfig($values);
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getEndpointsConfig()) {
            $values = new \stdClass();
            foreach ($object->getEndpointsConfig() as $key => $value) {
                $values->{$key} = $this->normalizer->normalize($value, 'json', $context);
            }
            $data->{'EndpointsConfig'} = $values;
        }

        return $data;
    }
}
