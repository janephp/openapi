<?php

namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class SchemaNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\Swagger\\Model\\Schema') {
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
            $values_69 = array();
            foreach ($data->{'required'} as $value_70) {
                $values_69[] = $value_70;
            }
            $object->setRequired($values_69);
        }
        if (isset($data->{'enum'})) {
            $values_71 = array();
            foreach ($data->{'enum'} as $value_72) {
                $values_71[] = $value_72;
            }
            $object->setEnum($values_71);
        }
        if (isset($data->{'additionalProperties'})) {
            $value_73 = $data->{'additionalProperties'};
            if (is_object($data->{'additionalProperties'})) {
                $value_73 = $this->serializer->deserialize($data->{'additionalProperties'}, 'Joli\\Jane\\Swagger\\Model\\Schema', 'raw', $context);
            }
            if (is_bool($data->{'additionalProperties'})) {
                $value_73 = $data->{'additionalProperties'};
            }
            $object->setAdditionalProperties($value_73);
        }
        if (isset($data->{'type'})) {
            $value_74 = $data->{'type'};
            if (isset($data->{'type'})) {
                $value_74 = $data->{'type'};
            }
            if (is_array($data->{'type'})) {
                $values_75 = array();
                foreach ($data->{'type'} as $value_76) {
                    $values_75[] = $value_76;
                }
                $value_74 = $values_75;
            }
            $object->setType($value_74);
        }
        if (isset($data->{'items'})) {
            $value_77 = $data->{'items'};
            if (is_object($data->{'items'})) {
                $value_77 = $this->serializer->deserialize($data->{'items'}, 'Joli\\Jane\\Swagger\\Model\\Schema', 'raw', $context);
            }
            if (is_array($data->{'items'})) {
                $values_78 = array();
                foreach ($data->{'items'} as $value_79) {
                    $values_78[] = $this->serializer->deserialize($value_79, 'Joli\\Jane\\Swagger\\Model\\Schema', 'raw', $context);
                }
                $value_77 = $values_78;
            }
            $object->setItems($value_77);
        }
        if (isset($data->{'allOf'})) {
            $values_80 = array();
            foreach ($data->{'allOf'} as $value_81) {
                $values_80[] = $this->serializer->deserialize($value_81, 'Joli\\Jane\\Swagger\\Model\\Schema', 'raw', $context);
            }
            $object->setAllOf($values_80);
        }
        if (isset($data->{'properties'})) {
            $values_82 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'properties'} as $key_84 => $value_83) {
                $values_82[$key_84] = $this->serializer->deserialize($value_83, 'Joli\\Jane\\Swagger\\Model\\Schema', 'raw', $context);
            }
            $object->setProperties($values_82);
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
}
