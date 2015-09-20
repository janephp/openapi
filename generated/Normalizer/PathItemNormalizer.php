<?php

namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class PathItemNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\Swagger\\Model\\PathItem') {
            return false;
        }

        return true;
    }
    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \Joli\Jane\Swagger\Model\PathItem) {
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
            $values_97 = array();
            foreach ($data->{'parameters'} as $value_98) {
                $value_99 = $value_98;
                if (is_object($value_98) and isset($value_98->{'name'}) and (isset($value_98->{'in'}) and $value_98->{'in'} == 'body') and isset($value_98->{'schema'})) {
                    $value_99 = $this->serializer->deserialize($value_98, 'Joli\\Jane\\Swagger\\Model\\BodyParameter', 'raw', $context);
                }
                if (is_object($value_98) and (isset($value_98->{'in'}) and $value_98->{'in'} == 'header') and isset($value_98->{'name'}) and (isset($value_98->{'type'}) and ($value_98->{'type'} == 'string' or $value_98->{'type'} == 'number' or $value_98->{'type'} == 'boolean' or $value_98->{'type'} == 'integer' or $value_98->{'type'} == 'array'))) {
                    $value_99 = $this->serializer->deserialize($value_98, 'Joli\\Jane\\Swagger\\Model\\HeaderParameterSubSchema', 'raw', $context);
                }
                if (is_object($value_98) and (isset($value_98->{'in'}) and $value_98->{'in'} == 'formData') and isset($value_98->{'name'}) and (isset($value_98->{'type'}) and ($value_98->{'type'} == 'string' or $value_98->{'type'} == 'number' or $value_98->{'type'} == 'boolean' or $value_98->{'type'} == 'integer' or $value_98->{'type'} == 'array' or $value_98->{'type'} == 'file'))) {
                    $value_99 = $this->serializer->deserialize($value_98, 'Joli\\Jane\\Swagger\\Model\\FormDataParameterSubSchema', 'raw', $context);
                }
                if (is_object($value_98) and (isset($value_98->{'in'}) and $value_98->{'in'} == 'query') and isset($value_98->{'name'}) and (isset($value_98->{'type'}) and ($value_98->{'type'} == 'string' or $value_98->{'type'} == 'number' or $value_98->{'type'} == 'boolean' or $value_98->{'type'} == 'integer' or $value_98->{'type'} == 'array'))) {
                    $value_99 = $this->serializer->deserialize($value_98, 'Joli\\Jane\\Swagger\\Model\\QueryParameterSubSchema', 'raw', $context);
                }
                if (is_object($value_98) and (isset($value_98->{'in'}) and $value_98->{'in'} == 'path') and isset($value_98->{'name'}) and (isset($value_98->{'type'}) and ($value_98->{'type'} == 'string' or $value_98->{'type'} == 'number' or $value_98->{'type'} == 'boolean' or $value_98->{'type'} == 'integer' or $value_98->{'type'} == 'array'))) {
                    $value_99 = $this->serializer->deserialize($value_98, 'Joli\\Jane\\Swagger\\Model\\PathParameterSubSchema', 'raw', $context);
                }
                $values_97[] = $value_99;
            }
            $object->setParameters($values_97);
        }

        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = new \stdClass();
        if (null !== $object->getDollarRef()) {
            $data->{'$ref'} = $object->getDollarRef();
        }
        if (null !== $object->getGet()) {
            $data->{'get'} = $this->serializer->serialize($object->getGet(), 'raw', $context);
        }
        if (null !== $object->getPut()) {
            $data->{'put'} = $this->serializer->serialize($object->getPut(), 'raw', $context);
        }
        if (null !== $object->getPost()) {
            $data->{'post'} = $this->serializer->serialize($object->getPost(), 'raw', $context);
        }
        if (null !== $object->getDelete()) {
            $data->{'delete'} = $this->serializer->serialize($object->getDelete(), 'raw', $context);
        }
        if (null !== $object->getOptions()) {
            $data->{'options'} = $this->serializer->serialize($object->getOptions(), 'raw', $context);
        }
        if (null !== $object->getHead()) {
            $data->{'head'} = $this->serializer->serialize($object->getHead(), 'raw', $context);
        }
        if (null !== $object->getPatch()) {
            $data->{'patch'} = $this->serializer->serialize($object->getPatch(), 'raw', $context);
        }
        if (null !== $object->getParameters()) {
            $values_100 = array();
            foreach ($object->getParameters() as $value_101) {
                $value_102 = $value_101;
                if (is_object($value_101)) {
                    $value_102 = $this->serializer->serialize($value_101, 'raw', $context);
                }
                if (is_object($value_101)) {
                    $value_102 = $this->serializer->serialize($value_101, 'raw', $context);
                }
                if (is_object($value_101)) {
                    $value_102 = $this->serializer->serialize($value_101, 'raw', $context);
                }
                if (is_object($value_101)) {
                    $value_102 = $this->serializer->serialize($value_101, 'raw', $context);
                }
                if (is_object($value_101)) {
                    $value_102 = $this->serializer->serialize($value_101, 'raw', $context);
                }
                $values_100[] = $value_102;
            }
            $data->{'parameters'} = $values_100;
        }

        return $data;
    }
}
