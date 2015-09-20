<?php

namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class SchemaNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\Swagger\\Model\\Schema') {
            return false;
        }

        return true;
    }
    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \Joli\Jane\Swagger\Model\Schema) {
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
        $object = new \Joli\Jane\Swagger\Model\Schema();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (isset($data->{'$ref'})) {
            $object->setDollarRef($data->{'$ref'});
        }
        if (isset($data->{'format'})) {
            $object->setFormat($data->{'format'});
        }
        if (isset($data->{'title'})) {
            $object->setTitle($data->{'title'});
        }
        if (isset($data->{'description'})) {
            $object->setDescription($data->{'description'});
        }
        if (isset($data->{'default'})) {
            $object->setDefault($data->{'default'});
        }
        if (isset($data->{'multipleOf'})) {
            $object->setMultipleOf($data->{'multipleOf'});
        }
        if (isset($data->{'maximum'})) {
            $object->setMaximum($data->{'maximum'});
        }
        if (isset($data->{'exclusiveMaximum'})) {
            $object->setExclusiveMaximum($data->{'exclusiveMaximum'});
        }
        if (isset($data->{'minimum'})) {
            $object->setMinimum($data->{'minimum'});
        }
        if (isset($data->{'exclusiveMinimum'})) {
            $object->setExclusiveMinimum($data->{'exclusiveMinimum'});
        }
        if (isset($data->{'maxLength'})) {
            $object->setMaxLength($data->{'maxLength'});
        }
        if (isset($data->{'minLength'})) {
            $object->setMinLength($data->{'minLength'});
        }
        if (isset($data->{'pattern'})) {
            $object->setPattern($data->{'pattern'});
        }
        if (isset($data->{'maxItems'})) {
            $object->setMaxItems($data->{'maxItems'});
        }
        if (isset($data->{'minItems'})) {
            $object->setMinItems($data->{'minItems'});
        }
        if (isset($data->{'uniqueItems'})) {
            $object->setUniqueItems($data->{'uniqueItems'});
        }
        if (isset($data->{'maxProperties'})) {
            $object->setMaxProperties($data->{'maxProperties'});
        }
        if (isset($data->{'minProperties'})) {
            $object->setMinProperties($data->{'minProperties'});
        }
        if (isset($data->{'required'})) {
            $values_132 = array();
            foreach ($data->{'required'} as $value_133) {
                $values_132[] = $value_133;
            }
            $object->setRequired($values_132);
        }
        if (isset($data->{'enum'})) {
            $values_134 = array();
            foreach ($data->{'enum'} as $value_135) {
                $values_134[] = $value_135;
            }
            $object->setEnum($values_134);
        }
        if (isset($data->{'additionalProperties'})) {
            $value_136 = $data->{'additionalProperties'};
            if (is_object($data->{'additionalProperties'})) {
                $value_136 = $this->serializer->deserialize($data->{'additionalProperties'}, 'Joli\\Jane\\Swagger\\Model\\Schema', 'raw', $context);
            }
            if (is_bool($data->{'additionalProperties'})) {
                $value_136 = $data->{'additionalProperties'};
            }
            $object->setAdditionalProperties($value_136);
        }
        if (isset($data->{'type'})) {
            $value_137 = $data->{'type'};
            if (isset($data->{'type'})) {
                $value_137 = $data->{'type'};
            }
            if (is_array($data->{'type'})) {
                $values_138 = array();
                foreach ($data->{'type'} as $value_139) {
                    $values_138[] = $value_139;
                }
                $value_137 = $values_138;
            }
            $object->setType($value_137);
        }
        if (isset($data->{'items'})) {
            $value_140 = $data->{'items'};
            if (is_object($data->{'items'})) {
                $value_140 = $this->serializer->deserialize($data->{'items'}, 'Joli\\Jane\\Swagger\\Model\\Schema', 'raw', $context);
            }
            if (is_array($data->{'items'})) {
                $values_141 = array();
                foreach ($data->{'items'} as $value_142) {
                    $values_141[] = $this->serializer->deserialize($value_142, 'Joli\\Jane\\Swagger\\Model\\Schema', 'raw', $context);
                }
                $value_140 = $values_141;
            }
            $object->setItems($value_140);
        }
        if (isset($data->{'allOf'})) {
            $values_143 = array();
            foreach ($data->{'allOf'} as $value_144) {
                $values_143[] = $this->serializer->deserialize($value_144, 'Joli\\Jane\\Swagger\\Model\\Schema', 'raw', $context);
            }
            $object->setAllOf($values_143);
        }
        if (isset($data->{'properties'})) {
            $values_145 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'properties'} as $key_147 => $value_146) {
                $values_145[$key_147] = $this->serializer->deserialize($value_146, 'Joli\\Jane\\Swagger\\Model\\Schema', 'raw', $context);
            }
            $object->setProperties($values_145);
        }
        if (isset($data->{'discriminator'})) {
            $object->setDiscriminator($data->{'discriminator'});
        }
        if (isset($data->{'readOnly'})) {
            $object->setReadOnly($data->{'readOnly'});
        }
        if (isset($data->{'xml'})) {
            $object->setXml($this->serializer->deserialize($data->{'xml'}, 'Joli\\Jane\\Swagger\\Model\\Xml', 'raw', $context));
        }
        if (isset($data->{'externalDocs'})) {
            $object->setExternalDocs($this->serializer->deserialize($data->{'externalDocs'}, 'Joli\\Jane\\Swagger\\Model\\ExternalDocs', 'raw', $context));
        }
        if (isset($data->{'example'})) {
            $object->setExample($data->{'example'});
        }

        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = new \stdClass();
        if (null !== $object->getDollarRef()) {
            $data->{'$ref'} = $object->getDollarRef();
        }
        if (null !== $object->getFormat()) {
            $data->{'format'} = $object->getFormat();
        }
        if (null !== $object->getTitle()) {
            $data->{'title'} = $object->getTitle();
        }
        if (null !== $object->getDescription()) {
            $data->{'description'} = $object->getDescription();
        }
        if (null !== $object->getDefault()) {
            $data->{'default'} = $object->getDefault();
        }
        if (null !== $object->getMultipleOf()) {
            $data->{'multipleOf'} = $object->getMultipleOf();
        }
        if (null !== $object->getMaximum()) {
            $data->{'maximum'} = $object->getMaximum();
        }
        if (null !== $object->getExclusiveMaximum()) {
            $data->{'exclusiveMaximum'} = $object->getExclusiveMaximum();
        }
        if (null !== $object->getMinimum()) {
            $data->{'minimum'} = $object->getMinimum();
        }
        if (null !== $object->getExclusiveMinimum()) {
            $data->{'exclusiveMinimum'} = $object->getExclusiveMinimum();
        }
        if (null !== $object->getMaxLength()) {
            $data->{'maxLength'} = $object->getMaxLength();
        }
        if (null !== $object->getMinLength()) {
            $data->{'minLength'} = $object->getMinLength();
        }
        if (null !== $object->getPattern()) {
            $data->{'pattern'} = $object->getPattern();
        }
        if (null !== $object->getMaxItems()) {
            $data->{'maxItems'} = $object->getMaxItems();
        }
        if (null !== $object->getMinItems()) {
            $data->{'minItems'} = $object->getMinItems();
        }
        if (null !== $object->getUniqueItems()) {
            $data->{'uniqueItems'} = $object->getUniqueItems();
        }
        if (null !== $object->getMaxProperties()) {
            $data->{'maxProperties'} = $object->getMaxProperties();
        }
        if (null !== $object->getMinProperties()) {
            $data->{'minProperties'} = $object->getMinProperties();
        }
        if (null !== $object->getRequired()) {
            $values_148 = array();
            foreach ($object->getRequired() as $value_149) {
                $values_148[] = $value_149;
            }
            $data->{'required'} = $values_148;
        }
        if (null !== $object->getEnum()) {
            $values_150 = array();
            foreach ($object->getEnum() as $value_151) {
                $values_150[] = $value_151;
            }
            $data->{'enum'} = $values_150;
        }
        if (null !== $object->getAdditionalProperties()) {
            $value_152 = $object->getAdditionalProperties();
            if (is_object($object->getAdditionalProperties())) {
                $value_152 = $this->serializer->serialize($object->getAdditionalProperties(), 'raw', $context);
            }
            if (is_bool($object->getAdditionalProperties())) {
                $value_152 = $object->getAdditionalProperties();
            }
            $data->{'additionalProperties'} = $value_152;
        }
        if (null !== $object->getType()) {
            $value_153 = $object->getType();
            if (!is_null($object->getType())) {
                $value_153 = $object->getType();
            }
            if (is_array($object->getType())) {
                $values_154 = array();
                foreach ($object->getType() as $value_155) {
                    $values_154[] = $value_155;
                }
                $value_153 = $values_154;
            }
            $data->{'type'} = $value_153;
        }
        if (null !== $object->getItems()) {
            $value_156 = $object->getItems();
            if (is_object($object->getItems())) {
                $value_156 = $this->serializer->serialize($object->getItems(), 'raw', $context);
            }
            if (is_array($object->getItems())) {
                $values_157 = array();
                foreach ($object->getItems() as $value_158) {
                    $values_157[] = $this->serializer->serialize($value_158, 'raw', $context);
                }
                $value_156 = $values_157;
            }
            $data->{'items'} = $value_156;
        }
        if (null !== $object->getAllOf()) {
            $values_159 = array();
            foreach ($object->getAllOf() as $value_160) {
                $values_159[] = $this->serializer->serialize($value_160, 'raw', $context);
            }
            $data->{'allOf'} = $values_159;
        }
        if (null !== $object->getProperties()) {
            $values_161 = new \stdClass();
            foreach ($object->getProperties() as $key_163 => $value_162) {
                $values_161->{$key_163} = $this->serializer->serialize($value_162, 'raw', $context);
            }
            $data->{'properties'} = $values_161;
        }
        if (null !== $object->getDiscriminator()) {
            $data->{'discriminator'} = $object->getDiscriminator();
        }
        if (null !== $object->getReadOnly()) {
            $data->{'readOnly'} = $object->getReadOnly();
        }
        if (null !== $object->getXml()) {
            $data->{'xml'} = $this->serializer->serialize($object->getXml(), 'raw', $context);
        }
        if (null !== $object->getExternalDocs()) {
            $data->{'externalDocs'} = $this->serializer->serialize($object->getExternalDocs(), 'raw', $context);
        }
        if (null !== $object->getExample()) {
            $data->{'example'} = $object->getExample();
        }

        return $data;
    }
}
