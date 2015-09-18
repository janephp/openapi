<?php

namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class Oauth2AccessCodeSecurityNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\Swagger\\Model\\Oauth2AccessCodeSecurity') {
            return false;
        }

        return true;
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
            $values_96 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'scopes'} as $key_98 => $value_97) {
                $values_96[$key_98] = $value_97;
            }
            $object->setScopes($values_96);
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
}
