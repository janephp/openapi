<?php

namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class PathItemNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\Swagger\\Model\\PathItem') {
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
        $object = new \Joli\Jane\Swagger\Model\PathItem();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (isset($data->{'$ref'})) {
            $object->setDollarRef($data->{'$ref'});
        }
        if (isset($data->{'get'})) {
            $object->setGet($this->serializer->deserialize($data->{'get'}, 'Joli\\Jane\\Swagger\\Model\\Operation', 'raw', $context));
        }
        if (isset($data->{'put'})) {
            $object->setPut($this->serializer->deserialize($data->{'put'}, 'Joli\\Jane\\Swagger\\Model\\Operation', 'raw', $context));
        }
        if (isset($data->{'post'})) {
            $object->setPost($this->serializer->deserialize($data->{'post'}, 'Joli\\Jane\\Swagger\\Model\\Operation', 'raw', $context));
        }
        if (isset($data->{'delete'})) {
            $object->setDelete($this->serializer->deserialize($data->{'delete'}, 'Joli\\Jane\\Swagger\\Model\\Operation', 'raw', $context));
        }
        if (isset($data->{'options'})) {
            $object->setOptions($this->serializer->deserialize($data->{'options'}, 'Joli\\Jane\\Swagger\\Model\\Operation', 'raw', $context));
        }
        if (isset($data->{'head'})) {
            $object->setHead($this->serializer->deserialize($data->{'head'}, 'Joli\\Jane\\Swagger\\Model\\Operation', 'raw', $context));
        }
        if (isset($data->{'patch'})) {
            $object->setPatch($this->serializer->deserialize($data->{'patch'}, 'Joli\\Jane\\Swagger\\Model\\Operation', 'raw', $context));
        }
        if (isset($data->{'parameters'})) {
            $values_50 = array();
            foreach ($data->{'parameters'} as $value_51) {
                $value_52 = $value_51;
                if (is_object($value_51) and isset($value_51->{'name'}) and (isset($value_51->{'in'}) and $value_51->{'in'} == 'body') and isset($value_51->{'schema'})) {
                    $value_52 = $this->serializer->deserialize($value_51, 'Joli\\Jane\\Swagger\\Model\\BodyParameter', 'raw', $context);
                }
                if (is_object($value_51) and (isset($value_51->{'in'}) and $value_51->{'in'} == 'header') and isset($value_51->{'name'}) and (isset($value_51->{'type'}) and ($value_51->{'type'} == 'string' or $value_51->{'type'} == 'number' or $value_51->{'type'} == 'boolean' or $value_51->{'type'} == 'integer' or $value_51->{'type'} == 'array'))) {
                    $value_52 = $this->serializer->deserialize($value_51, 'Joli\\Jane\\Swagger\\Model\\HeaderParameterSubSchema', 'raw', $context);
                }
                if (is_object($value_51) and (isset($value_51->{'in'}) and $value_51->{'in'} == 'formData') and isset($value_51->{'name'}) and (isset($value_51->{'type'}) and ($value_51->{'type'} == 'string' or $value_51->{'type'} == 'number' or $value_51->{'type'} == 'boolean' or $value_51->{'type'} == 'integer' or $value_51->{'type'} == 'array' or $value_51->{'type'} == 'file'))) {
                    $value_52 = $this->serializer->deserialize($value_51, 'Joli\\Jane\\Swagger\\Model\\FormDataParameterSubSchema', 'raw', $context);
                }
                if (is_object($value_51) and (isset($value_51->{'in'}) and $value_51->{'in'} == 'query') and isset($value_51->{'name'}) and (isset($value_51->{'type'}) and ($value_51->{'type'} == 'string' or $value_51->{'type'} == 'number' or $value_51->{'type'} == 'boolean' or $value_51->{'type'} == 'integer' or $value_51->{'type'} == 'array'))) {
                    $value_52 = $this->serializer->deserialize($value_51, 'Joli\\Jane\\Swagger\\Model\\QueryParameterSubSchema', 'raw', $context);
                }
                if (is_object($value_51) and (isset($value_51->{'in'}) and $value_51->{'in'} == 'path') and isset($value_51->{'name'}) and (isset($value_51->{'type'}) and ($value_51->{'type'} == 'string' or $value_51->{'type'} == 'number' or $value_51->{'type'} == 'boolean' or $value_51->{'type'} == 'integer' or $value_51->{'type'} == 'array'))) {
                    $value_52 = $this->serializer->deserialize($value_51, 'Joli\\Jane\\Swagger\\Model\\PathParameterSubSchema', 'raw', $context);
                }
                $values_50[] = $value_52;
            }
            $object->setParameters($values_50);
        }

        return $object;
    }
}
