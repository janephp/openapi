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
            $values_203 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'scopes'} as $key_205 => $value_204) {
                $values_203[$key_205] = $value_204;
            }
            $object->setScopes($values_203);
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
            $values_206 = new \stdClass();
            foreach ($object->getScopes() as $key_208 => $value_207) {
                $values_206->{$key_208} = $value_207;
            }
            $data->{'scopes'} = $values_206;
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
