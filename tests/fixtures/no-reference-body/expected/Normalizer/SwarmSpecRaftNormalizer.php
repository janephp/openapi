<?php

namespace Joli\Jane\OpenApi\Tests\Expected\Normalizer;

use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SwarmSpecRaftNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\OpenApi\\Tests\\Expected\\Model\\SwarmSpecRaft') {
            return false;
        }

        return true;
    }

    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \Joli\Jane\OpenApi\Tests\Expected\Model\SwarmSpecRaft) {
            return true;
        }

        return false;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (!is_object($data)) {
            throw new InvalidArgumentException();
        }
        $object = new \Joli\Jane\OpenApi\Tests\Expected\Model\SwarmSpecRaft();
        if (property_exists($data, 'SnapshotInterval')) {
            $object->setSnapshotInterval($data->{'SnapshotInterval'});
        }
        if (property_exists($data, 'KeepOldSnapshots')) {
            $object->setKeepOldSnapshots($data->{'KeepOldSnapshots'});
        }
        if (property_exists($data, 'LogEntriesForSlowFollowers')) {
            $object->setLogEntriesForSlowFollowers($data->{'LogEntriesForSlowFollowers'});
        }
        if (property_exists($data, 'ElectionTick')) {
            $object->setElectionTick($data->{'ElectionTick'});
        }
        if (property_exists($data, 'HeartbeatTick')) {
            $object->setHeartbeatTick($data->{'HeartbeatTick'});
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getSnapshotInterval()) {
            $data->{'SnapshotInterval'} = $object->getSnapshotInterval();
        }
        if (null !== $object->getKeepOldSnapshots()) {
            $data->{'KeepOldSnapshots'} = $object->getKeepOldSnapshots();
        }
        if (null !== $object->getLogEntriesForSlowFollowers()) {
            $data->{'LogEntriesForSlowFollowers'} = $object->getLogEntriesForSlowFollowers();
        }
        if (null !== $object->getElectionTick()) {
            $data->{'ElectionTick'} = $object->getElectionTick();
        }
        if (null !== $object->getHeartbeatTick()) {
            $data->{'HeartbeatTick'} = $object->getHeartbeatTick();
        }

        return $data;
    }
}
