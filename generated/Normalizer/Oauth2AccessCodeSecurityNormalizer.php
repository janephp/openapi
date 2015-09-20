<?php

namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class Oauth2AccessCodeSecurityNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\Swagger\\Model\\Oauth2AccessCodeSecurity') {
            return false;
        }

        return true;
    }
    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \Joli\Jane\Swagger\Model\Oauth2AccessCodeSecurity) {
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
        $object = new \Joli\Jane\Swagger\Model\Oauth2AccessCodeSecurity();
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
            $values_186 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'scopes'} as $key_188 => $value_187) {
                $values_186[$key_188] = $value_187;
            }
            $object->setScopes($values_186);
        }
        if (isset($data->{'authorizationUrl'})) {
            $object->setAuthorizationUrl($data->{'authorizationUrl'});
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
            $values_189 = new \stdClass();
            foreach ($object->getScopes() as $key_191 => $value_190) {
                $values_189->{$key_191} = $value_190;
            }
            $data->{'scopes'} = $values_189;
        }
        if (null !== $object->getAuthorizationUrl()) {
            $data->{'authorizationUrl'} = $object->getAuthorizationUrl();
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
