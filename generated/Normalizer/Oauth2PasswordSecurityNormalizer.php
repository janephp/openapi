<?php

namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class Oauth2PasswordSecurityNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\Swagger\\Model\\Oauth2PasswordSecurity') {
            return false;
        }

        return true;
    }
    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \Joli\Jane\Swagger\Model\Oauth2PasswordSecurity) {
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
        $object = new \Joli\Jane\Swagger\Model\Oauth2PasswordSecurity();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (isset($data->{'type'})) {
            $object->setType($data->{'type'});
        }
        if (isset($data->{'flow'})) {
            $object->setFlow($data->{'flow'});
        }
        if (isset($data->{'scopes'})) {
            $values_174 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'scopes'} as $key_176 => $value_175) {
                $values_174[$key_176] = $value_175;
            }
            $object->setScopes($values_174);
        }
        if (isset($data->{'tokenUrl'})) {
            $object->setTokenUrl($data->{'tokenUrl'});
        }
        if (isset($data->{'description'})) {
            $object->setDescription($data->{'description'});
        }

        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = new \stdClass();
        if (null !== $object->getType()) {
            $data->{'type'} = $object->getType();
        }
        if (null !== $object->getFlow()) {
            $data->{'flow'} = $object->getFlow();
        }
        if (null !== $object->getScopes()) {
            $values_177 = new \stdClass();
            foreach ($object->getScopes() as $key_179 => $value_178) {
                $values_177->{$key_179} = $value_178;
            }
            $data->{'scopes'} = $values_177;
        }
        if (null !== $object->getTokenUrl()) {
            $data->{'tokenUrl'} = $object->getTokenUrl();
        }
        if (null !== $object->getDescription()) {
            $data->{'description'} = $object->getDescription();
        }

        return $data;
    }
}
