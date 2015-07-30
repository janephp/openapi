<?php

namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class PathItemNormalizer implements DenormalizerInterface
{
    public $normalizerChain;
    public function setNormalizerChain(NormalizerChain $normalizerChain)
    {
        $this->normalizerChain = $normalizerChain;
    }
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\Swagger\\Model\\PathItem') {
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
        $object = new \Joli\Jane\Swagger\Model\PathItem();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (isset($data->{'$ref'})) {
            $object->setDollarRef($data->{'$ref'});
        }
        if (isset($data->{'get'})) {
            $object->setGet($this->normalizerChain->denormalize($data->{'get'}, 'Joli\\Jane\\Swagger\\Model\\Operation', 'json', $context));
        }
        if (isset($data->{'put'})) {
            $object->setPut($this->normalizerChain->denormalize($data->{'put'}, 'Joli\\Jane\\Swagger\\Model\\Operation', 'json', $context));
        }
        if (isset($data->{'post'})) {
            $object->setPost($this->normalizerChain->denormalize($data->{'post'}, 'Joli\\Jane\\Swagger\\Model\\Operation', 'json', $context));
        }
        if (isset($data->{'delete'})) {
            $object->setDelete($this->normalizerChain->denormalize($data->{'delete'}, 'Joli\\Jane\\Swagger\\Model\\Operation', 'json', $context));
        }
        if (isset($data->{'options'})) {
            $object->setOptions($this->normalizerChain->denormalize($data->{'options'}, 'Joli\\Jane\\Swagger\\Model\\Operation', 'json', $context));
        }
        if (isset($data->{'head'})) {
            $object->setHead($this->normalizerChain->denormalize($data->{'head'}, 'Joli\\Jane\\Swagger\\Model\\Operation', 'json', $context));
        }
        if (isset($data->{'patch'})) {
            $object->setPatch($this->normalizerChain->denormalize($data->{'patch'}, 'Joli\\Jane\\Swagger\\Model\\Operation', 'json', $context));
        }
        if (isset($data->{'parameters'})) {
            $values_63 = array();
            foreach ($data->{'parameters'} as $value_64) {
                $value_65 = $value_64;
                if (is_object($value_64) and $value_64->{'in'} == 'body') {
                    $value_65 = $this->normalizerChain->denormalize($value_64, 'Joli\\Jane\\Swagger\\Model\\BodyParameter', 'json', $context);
                } elseif (isset($value_64)) {
                    $value_66 = $value_64;
                    if (is_object($value_64) and $value_64->{'in'} == 'header' and ($value_64->{'type'} == 'string' or $value_64->{'type'} == 'number' or $value_64->{'type'} == 'boolean' or $value_64->{'type'} == 'integer' or $value_64->{'type'} == 'array')) {
                        $value_66 = $this->normalizerChain->denormalize($value_64, 'Joli\\Jane\\Swagger\\Model\\HeaderParameterSubSchema', 'json', $context);
                    } elseif (is_object($value_64) and $value_64->{'in'} == 'formData' and ($value_64->{'type'} == 'string' or $value_64->{'type'} == 'number' or $value_64->{'type'} == 'boolean' or $value_64->{'type'} == 'integer' or $value_64->{'type'} == 'array' or $value_64->{'type'} == 'file')) {
                        $value_66 = $this->normalizerChain->denormalize($value_64, 'Joli\\Jane\\Swagger\\Model\\FormDataParameterSubSchema', 'json', $context);
                    } elseif (is_object($value_64) and $value_64->{'in'} == 'query' and ($value_64->{'type'} == 'string' or $value_64->{'type'} == 'number' or $value_64->{'type'} == 'boolean' or $value_64->{'type'} == 'integer' or $value_64->{'type'} == 'array')) {
                        $value_66 = $this->normalizerChain->denormalize($value_64, 'Joli\\Jane\\Swagger\\Model\\QueryParameterSubSchema', 'json', $context);
                    } elseif (is_object($value_64) and $value_64->{'in'} == 'path' and ($value_64->{'type'} == 'string' or $value_64->{'type'} == 'number' or $value_64->{'type'} == 'boolean' or $value_64->{'type'} == 'integer' or $value_64->{'type'} == 'array')) {
                        $value_66 = $this->normalizerChain->denormalize($value_64, 'Joli\\Jane\\Swagger\\Model\\PathParameterSubSchema', 'json', $context);
                    }
                    $value_65 = $value_66;
                }
                $values_63[] = $value_65;
            }
            $object->setParameters($values_63);
        }

        return $object;
    }
}
