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

    public function denormalize($data, $class, $format = null, array $context = [])
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
            $values_145 = [];
            foreach ($data->{'required'} as $value_146) {
                $values_145[] = $value_146;
            }
            $object->setRequired($values_145);
        }
        if (isset($data->{'enum'})) {
            $values_147 = [];
            foreach ($data->{'enum'} as $value_148) {
                $values_147[] = $value_148;
            }
            $object->setEnum($values_147);
        }
        if (isset($data->{'additionalProperties'})) {
            $value_149 = $data->{'additionalProperties'};
            if (is_object($data->{'additionalProperties'})) {
                $value_149 = $this->serializer->deserialize($data->{'additionalProperties'}, 'Joli\\Jane\\Swagger\\Model\\Schema', 'raw', $context);
            }
            if (is_bool($data->{'additionalProperties'})) {
                $value_149 = $data->{'additionalProperties'};
            }
            $object->setAdditionalProperties($value_149);
        }
        if (isset($data->{'type'})) {
            $value_150 = $data->{'type'};
            if (isset($data->{'type'})) {
                $value_150 = $data->{'type'};
            }
            if (is_array($data->{'type'})) {
                $values_151 = [];
                foreach ($data->{'type'} as $value_152) {
                    $values_151[] = $value_152;
                }
                $value_150 = $values_151;
            }
            $object->setType($value_150);
        }
        if (isset($data->{'items'})) {
            $value_153 = $data->{'items'};
            if (is_object($data->{'items'})) {
                $value_153 = $this->serializer->deserialize($data->{'items'}, 'Joli\\Jane\\Swagger\\Model\\Schema', 'raw', $context);
            }
            if (is_array($data->{'items'})) {
                $values_154 = [];
                foreach ($data->{'items'} as $value_155) {
                    $values_154[] = $this->serializer->deserialize($value_155, 'Joli\\Jane\\Swagger\\Model\\Schema', 'raw', $context);
                }
                $value_153 = $values_154;
            }
            $object->setItems($value_153);
        }
        if (isset($data->{'allOf'})) {
            $values_156 = [];
            foreach ($data->{'allOf'} as $value_157) {
                $values_156[] = $this->serializer->deserialize($value_157, 'Joli\\Jane\\Swagger\\Model\\Schema', 'raw', $context);
            }
            $object->setAllOf($values_156);
        }
        if (isset($data->{'properties'})) {
            $values_158 = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'properties'} as $key_160 => $value_159) {
                $values_158[$key_160] = $this->serializer->deserialize($value_159, 'Joli\\Jane\\Swagger\\Model\\Schema', 'raw', $context);
            }
            $object->setProperties($values_158);
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

    public function normalize($object, $format = null, array $context = [])
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
            $values_161 = [];
            foreach ($object->getRequired() as $value_162) {
                $values_161[] = $value_162;
            }
            $data->{'required'} = $values_161;
        }
        if (null !== $object->getEnum()) {
            $values_163 = [];
            foreach ($object->getEnum() as $value_164) {
                $values_163[] = $value_164;
            }
            $data->{'enum'} = $values_163;
        }
        if (null !== $object->getAdditionalProperties()) {
            $value_165 = $object->getAdditionalProperties();
            if (is_object($object->getAdditionalProperties())) {
                $value_165 = $this->serializer->serialize($object->getAdditionalProperties(), 'raw', $context);
            }
            if (is_bool($object->getAdditionalProperties())) {
                $value_165 = $object->getAdditionalProperties();
            }
            $data->{'additionalProperties'} = $value_165;
        }
        if (null !== $object->getType()) {
            $value_166 = $object->getType();
            if (!is_null($object->getType())) {
                $value_166 = $object->getType();
            }
            if (is_array($object->getType())) {
                $values_167 = [];
                foreach ($object->getType() as $value_168) {
                    $values_167[] = $value_168;
                }
                $value_166 = $values_167;
            }
            $data->{'type'} = $value_166;
        }
        if (null !== $object->getItems()) {
            $value_169 = $object->getItems();
            if (is_object($object->getItems())) {
                $value_169 = $this->serializer->serialize($object->getItems(), 'raw', $context);
            }
            if (is_array($object->getItems())) {
                $values_170 = [];
                foreach ($object->getItems() as $value_171) {
                    $values_170[] = $this->serializer->serialize($value_171, 'raw', $context);
                }
                $value_169 = $values_170;
            }
            $data->{'items'} = $value_169;
        }
        if (null !== $object->getAllOf()) {
            $values_172 = [];
            foreach ($object->getAllOf() as $value_173) {
                $values_172[] = $this->serializer->serialize($value_173, 'raw', $context);
            }
            $data->{'allOf'} = $values_172;
        }
        if (null !== $object->getProperties()) {
            $values_174 = new \stdClass();
            foreach ($object->getProperties() as $key_176 => $value_175) {
                $values_174->{$key_176} = $this->serializer->serialize($value_175, 'raw', $context);
            }
            $data->{'properties'} = $values_174;
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
