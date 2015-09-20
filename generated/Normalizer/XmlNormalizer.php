<?php

namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class XmlNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\Swagger\\Model\\Xml') {
            return false;
        }

        return true;
    }
    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \Joli\Jane\Swagger\Model\Xml) {
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
        $object = new \Joli\Jane\Swagger\Model\Xml();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (isset($data->{'name'})) {
            $object->setName($data->{'name'});
        }
        if (isset($data->{'namespace'})) {
            $object->setNamespace($data->{'namespace'});
        }
        if (isset($data->{'prefix'})) {
            $object->setPrefix($data->{'prefix'});
        }
        if (isset($data->{'attribute'})) {
            $object->setAttribute($data->{'attribute'});
        }
        if (isset($data->{'wrapped'})) {
            $object->setWrapped($data->{'wrapped'});
        }

        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = new \stdClass();
        if (null !== $object->getName()) {
            $data->{'name'} = $object->getName();
        }
        if (null !== $object->getNamespace()) {
            $data->{'namespace'} = $object->getNamespace();
        }
        if (null !== $object->getPrefix()) {
            $data->{'prefix'} = $object->getPrefix();
        }
        if (null !== $object->getAttribute()) {
            $data->{'attribute'} = $object->getAttribute();
        }
        if (null !== $object->getWrapped()) {
            $data->{'wrapped'} = $object->getWrapped();
        }

        return $data;
    }
}
