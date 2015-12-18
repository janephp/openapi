<?php

namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class InfoNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\Swagger\\Model\\Info') {
            return false;
        }

        return true;
    }

    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \Joli\Jane\Swagger\Model\Info) {
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
        $object = new \Joli\Jane\Swagger\Model\Info();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (isset($data->{'title'})) {
            $object->setTitle($data->{'title'});
        }
        if (isset($data->{'version'})) {
            $object->setVersion($data->{'version'});
        }
        if (isset($data->{'description'})) {
            $object->setDescription($data->{'description'});
        }
        if (isset($data->{'termsOfService'})) {
            $object->setTermsOfService($data->{'termsOfService'});
        }
        if (isset($data->{'contact'})) {
            $object->setContact($this->serializer->deserialize($data->{'contact'}, 'Joli\\Jane\\Swagger\\Model\\Contact', 'raw', $context));
        }
        if (isset($data->{'license'})) {
            $object->setLicense($this->serializer->deserialize($data->{'license'}, 'Joli\\Jane\\Swagger\\Model\\License', 'raw', $context));
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getTitle()) {
            $data->{'title'} = $object->getTitle();
        }
        if (null !== $object->getVersion()) {
            $data->{'version'} = $object->getVersion();
        }
        if (null !== $object->getDescription()) {
            $data->{'description'} = $object->getDescription();
        }
        if (null !== $object->getTermsOfService()) {
            $data->{'termsOfService'} = $object->getTermsOfService();
        }
        if (null !== $object->getContact()) {
            $data->{'contact'} = $this->serializer->serialize($object->getContact(), 'raw', $context);
        }
        if (null !== $object->getLicense()) {
            $data->{'license'} = $this->serializer->serialize($object->getLicense(), 'raw', $context);
        }

        return $data;
    }
}
