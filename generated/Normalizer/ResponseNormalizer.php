<?php

namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ResponseNormalizer implements DenormalizerInterface
{
    public $normalizerChain;
    public function setNormalizerChain(NormalizerChain $normalizerChain)
    {
        $this->normalizerChain = $normalizerChain;
    }
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\Swagger\\Model\\Response') {
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
        $object = new \Joli\Jane\Swagger\Model\Response();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (isset($data->{'description'})) {
            $object->setDescription($data->{'description'});
        }
        if (isset($data->{'schema'})) {
            $object->setSchema($this->normalizerChain->denormalize($data->{'schema'}, 'Joli\\Jane\\Swagger\\Model\\Schema', 'json', $context));
        }
        if (isset($data->{'headers'})) {
            $values_46 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'headers'} as $key_47 => $value_48) {
                $values_46[$key_47] = $this->normalizerChain->denormalize($value_48, 'Joli\\Jane\\Swagger\\Model\\Header', 'json', $context);
            }
            $object->setHeaders($values_46);
        }
        if (isset($data->{'examples'})) {
            $values_51 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'examples'} as $key_52 => $value_53) {
                if (preg_match('/^[a-z0-9-]+\/[a-z0-9\-+]+$/', $key_52)) {
                    $values_51[$key_52] = $value_53;
                    continue;
                }
            }
            $object->setExamples($values_51);
        }

        return $object;
    }
}
