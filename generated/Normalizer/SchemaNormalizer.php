<?php

namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class SchemaNormalizer implements DenormalizerInterface
{
    public $normalizerChain;
    public function setNormalizerChain(NormalizerChain $normalizerChain)
    {
        $this->normalizerChain = $normalizerChain;
    }
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\Swagger\\Model\\Schema') {
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
            $value_15 = $data->{'minLength'};
            if (is_int($data->{'minLength'})) {
                $value_15 = $data->{'minLength'};
            } elseif (isset($data->{'minLength'})) {
                $value_15 = $data->{'minLength'};
            }
            $object->setMinLength($value_15);
        }
        if (isset($data->{'pattern'})) {
            $object->setPattern($data->{'pattern'});
        }
        if (isset($data->{'maxItems'})) {
            $object->setMaxItems($data->{'maxItems'});
        }
        if (isset($data->{'minItems'})) {
            $value_16 = $data->{'minItems'};
            if (is_int($data->{'minItems'})) {
                $value_16 = $data->{'minItems'};
            } elseif (isset($data->{'minItems'})) {
                $value_16 = $data->{'minItems'};
            }
            $object->setMinItems($value_16);
        }
        if (isset($data->{'uniqueItems'})) {
            $object->setUniqueItems($data->{'uniqueItems'});
        }
        if (isset($data->{'maxProperties'})) {
            $object->setMaxProperties($data->{'maxProperties'});
        }
        if (isset($data->{'minProperties'})) {
            $value_17 = $data->{'minProperties'};
            if (is_int($data->{'minProperties'})) {
                $value_17 = $data->{'minProperties'};
            } elseif (isset($data->{'minProperties'})) {
                $value_17 = $data->{'minProperties'};
            }
            $object->setMinProperties($value_17);
        }
        if (isset($data->{'required'})) {
            $values_18 = array();
            foreach ($data->{'required'} as $value_19) {
                $values_18[] = $value_19;
            }
            $object->setRequired($values_18);
        }
        if (isset($data->{'enum'})) {
            $object->setEnum($data->{'enum'});
        }
        if (isset($data->{'additionalProperties'})) {
            $value_20 = $data->{'additionalProperties'};
            if (is_object($data->{'additionalProperties'})) {
                $value_20 = $this->normalizerChain->denormalize($data->{'additionalProperties'}, 'Joli\\Jane\\Swagger\\Model\\Schema', 'json', $context);
            } elseif (is_bool($data->{'additionalProperties'})) {
                $value_20 = $data->{'additionalProperties'};
            }
            $object->setAdditionalProperties($value_20);
        }
        if (isset($data->{'type'})) {
            $value_21 = $data->{'type'};
            if (isset($data->{'type'})) {
                $value_21 = $data->{'type'};
            } elseif (is_array($data->{'type'})) {
                $values_22 = array();
                foreach ($data->{'type'} as $value_23) {
                    $values_22[] = $value_23;
                }
                $value_21 = $values_22;
            }
            $object->setType($value_21);
        }
        if (isset($data->{'items'})) {
            $value_24 = $data->{'items'};
            if (is_object($data->{'items'})) {
                $value_24 = $this->normalizerChain->denormalize($data->{'items'}, 'Joli\\Jane\\Swagger\\Model\\Schema', 'json', $context);
            } elseif (is_array($data->{'items'})) {
                $values_25 = array();
                foreach ($data->{'items'} as $value_26) {
                    $values_25[] = $this->normalizerChain->denormalize($value_26, 'Joli\\Jane\\Swagger\\Model\\Schema', 'json', $context);
                }
                $value_24 = $values_25;
            }
            $object->setItems($value_24);
        }
        if (isset($data->{'allOf'})) {
            $values_27 = array();
            foreach ($data->{'allOf'} as $value_28) {
                $values_27[] = $this->normalizerChain->denormalize($value_28, 'Joli\\Jane\\Swagger\\Model\\Schema', 'json', $context);
            }
            $object->setAllOf($values_27);
        }
        if (isset($data->{'properties'})) {
            $values_29 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'properties'} as $key_30 => $value_31) {
                $values_29[$key_30] = $this->normalizerChain->denormalize($value_31, 'Joli\\Jane\\Swagger\\Model\\Schema', 'json', $context);
            }
            $object->setProperties($values_29);
        }
        if (isset($data->{'discriminator'})) {
            $object->setDiscriminator($data->{'discriminator'});
        }
        if (isset($data->{'readOnly'})) {
            $object->setReadOnly($data->{'readOnly'});
        }
        if (isset($data->{'xml'})) {
            $object->setXml($this->normalizerChain->denormalize($data->{'xml'}, 'Joli\\Jane\\Swagger\\Model\\Xml', 'json', $context));
        }
        if (isset($data->{'externalDocs'})) {
            $object->setExternalDocs($this->normalizerChain->denormalize($data->{'externalDocs'}, 'Joli\\Jane\\Swagger\\Model\\ExternalDocs', 'json', $context));
        }
        if (isset($data->{'example'})) {
            $object->setExample($data->{'example'});
        }

        return $object;
    }
}
