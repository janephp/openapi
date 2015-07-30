<?php

namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class Oauth2ApplicationSecurityNormalizer implements DenormalizerInterface
{
    public $normalizerChain;
    public function setNormalizerChain(NormalizerChain $normalizerChain)
    {
        $this->normalizerChain = $normalizerChain;
    }
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\Swagger\\Model\\Oauth2ApplicationSecurity') {
            return false;
        }
        if ($format !== 'json') {
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
        $object = new \Joli\Jane\Swagger\Model\Oauth2ApplicationSecurity();
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
            $values_95 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'scopes'} as $key_96 => $value_97) {
                $values_95[$key_96] = $value_97;
            }
            $object->setScopes($values_95);
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
