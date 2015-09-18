<?php

namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class ResponseNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\Swagger\\Model\\Response') {
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
            $object->setSchema($this->serializer->deserialize($data->{'schema'}, 'Joli\\Jane\\Swagger\\Model\\Schema', 'raw', $context));
        }
        if (isset($data->{'headers'})) {
            $values_53 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'headers'} as $key_55 => $value_54) {
                $values_53[$key_55] = $this->serializer->deserialize($value_54, 'Joli\\Jane\\Swagger\\Model\\Header', 'raw', $context);
            }
            $object->setHeaders($values_53);
        }
        if (isset($data->{'examples'})) {
            $values_56 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'examples'} as $key_58 => $value_57) {
                if (preg_match('/^[a-z0-9-]+\/[a-z0-9\-+]+$/', $key_58) && isset($value_57)) {
                    $values_56[$key_58] = $value_57;
                    continue;
                }
            }
            $object->setExamples($values_56);
        }

        return $object;
    }
}
