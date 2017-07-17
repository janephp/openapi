<?php

namespace Joli\Jane\OpenApi\Tests\Expected\Normalizer;

use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SwarmSpecNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\OpenApi\\Tests\\Expected\\Model\\SwarmSpec') {
            return false;
        }

        return true;
    }

    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \Joli\Jane\OpenApi\Tests\Expected\Model\SwarmSpec) {
            return true;
        }

        return false;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (!is_object($data)) {
            throw new InvalidArgumentException();
        }
        $object = new \Joli\Jane\OpenApi\Tests\Expected\Model\SwarmSpec();
        if (property_exists($data, 'Name')) {
            $object->setName($data->{'Name'});
        }
        if (property_exists($data, 'Labels')) {
            $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'Labels'} as $key => $value) {
                $values[$key] = $value;
            }
            $object->setLabels($values);
        }
        if (property_exists($data, 'Orchestration')) {
            $object->setOrchestration($this->denormalizer->denormalize($data->{'Orchestration'}, 'Joli\\Jane\\OpenApi\\Tests\\Expected\\Model\\SwarmSpecOrchestration', 'json', $context));
        }
        if (property_exists($data, 'Raft')) {
            $object->setRaft($this->denormalizer->denormalize($data->{'Raft'}, 'Joli\\Jane\\OpenApi\\Tests\\Expected\\Model\\SwarmSpecRaft', 'json', $context));
        }
        if (property_exists($data, 'Dispatcher')) {
            $object->setDispatcher($this->denormalizer->denormalize($data->{'Dispatcher'}, 'Joli\\Jane\\OpenApi\\Tests\\Expected\\Model\\SwarmSpecDispatcher', 'json', $context));
        }
        if (property_exists($data, 'CAConfig')) {
            $object->setCAConfig($this->denormalizer->denormalize($data->{'CAConfig'}, 'Joli\\Jane\\OpenApi\\Tests\\Expected\\Model\\SwarmSpecCAConfig', 'json', $context));
        }
        if (property_exists($data, 'EncryptionConfig')) {
            $object->setEncryptionConfig($this->denormalizer->denormalize($data->{'EncryptionConfig'}, 'Joli\\Jane\\OpenApi\\Tests\\Expected\\Model\\SwarmSpecEncryptionConfig', 'json', $context));
        }
        if (property_exists($data, 'TaskDefaults')) {
            $object->setTaskDefaults($this->denormalizer->denormalize($data->{'TaskDefaults'}, 'Joli\\Jane\\OpenApi\\Tests\\Expected\\Model\\SwarmSpecTaskDefaults', 'json', $context));
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getName()) {
            $data->{'Name'} = $object->getName();
        }
        if (null !== $object->getLabels()) {
            $values = new \stdClass();
            foreach ($object->getLabels() as $key => $value) {
                $values->{$key} = $value;
            }
            $data->{'Labels'} = $values;
        }
        if (null !== $object->getOrchestration()) {
            $data->{'Orchestration'} = $this->normalizer->normalize($object->getOrchestration(), 'json', $context);
        }
        if (null !== $object->getRaft()) {
            $data->{'Raft'} = $this->normalizer->normalize($object->getRaft(), 'json', $context);
        }
        if (null !== $object->getDispatcher()) {
            $data->{'Dispatcher'} = $this->normalizer->normalize($object->getDispatcher(), 'json', $context);
        }
        if (null !== $object->getCAConfig()) {
            $data->{'CAConfig'} = $this->normalizer->normalize($object->getCAConfig(), 'json', $context);
        }
        if (null !== $object->getEncryptionConfig()) {
            $data->{'EncryptionConfig'} = $this->normalizer->normalize($object->getEncryptionConfig(), 'json', $context);
        }
        if (null !== $object->getTaskDefaults()) {
            $data->{'TaskDefaults'} = $this->normalizer->normalize($object->getTaskDefaults(), 'json', $context);
        }

        return $data;
    }
}
