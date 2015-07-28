<?php
namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Joli\Jane\Swagger\Normalizer\NormalizerChain;

class SchemaNormalizer implements DenormalizerInterface
{
    private $normalizerChain;

    public function setNormalizerChain(NormalizerChain $normalizerChain)
    {
        $this->normalizerChain = $normalizerChain;
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
            if (is_int($data->{'minLength'})) {
                $object->setMinLength($data->{'minLength'});
            }

            if (isset($data->{'minLength'})) {
                $object->setMinLength($data->{'minLength'});
            }
        }

        if (isset($data->{'pattern'})) {
            $object->setPattern($data->{'pattern'});
        }

        if (isset($data->{'maxItems'})) {
            $object->setMaxItems($data->{'maxItems'});
        }

        if (isset($data->{'minItems'})) {
            if (is_int($data->{'minItems'})) {
                $object->setMinItems($data->{'minItems'});
            }

            if (isset($data->{'minItems'})) {
                $object->setMinItems($data->{'minItems'});
            }
        }

        if (isset($data->{'uniqueItems'})) {
            $object->setUniqueItems($data->{'uniqueItems'});
        }

        if (isset($data->{'maxProperties'})) {
            $object->setMaxProperties($data->{'maxProperties'});
        }

        if (isset($data->{'minProperties'})) {
            if (is_int($data->{'minProperties'})) {
                $object->setMinProperties($data->{'minProperties'});
            }

            if (isset($data->{'minProperties'})) {
                $object->setMinProperties($data->{'minProperties'});
            }
        }

        if (isset($data->{'required'})) {
            $values = [];

            foreach ($data->{'required'} as $value) {
                $values[] = $value;
            }

            $object->setRequired($values);
        }

        if (isset($data->{'enum'})) {
            $object->setEnum($data->{'enum'});
        }

        if (isset($data->{'additionalProperties'})) {
            if (is_object($data->{'additionalProperties'})) {
                $object->setAdditionalProperties($this->normalizerChain->denormalize($data->{'additionalProperties'}, 'Joli\Jane\Swagger\Model\Schema', 'json', $context));
            }

            if (is_bool($data->{'additionalProperties'})) {
                $object->setAdditionalProperties($data->{'additionalProperties'});
            }
        }

        if (isset($data->{'type'})) {
            if (isset($data->{'type'})) {
                $object->setType($data->{'type'});
            }

            if (is_array($data->{'type'})) {
                $values = [];

                foreach ($data->{'type'} as $value) {
                    $values[] = $value;
                }

                $object->setType($values);
            }
        }

        if (isset($data->{'items'})) {
            if (is_object($data->{'items'})) {
                $object->setItems($this->normalizerChain->denormalize($data->{'items'}, 'Joli\Jane\Swagger\Model\Schema', 'json', $context));
            }

            if (is_array($data->{'items'})) {
                $values = [];

                foreach ($data->{'items'} as $value) {
                    $values[] = $this->normalizerChain->denormalize($value, 'Joli\Jane\Swagger\Model\Schema', 'json', $context);
                }

                $object->setItems($values);
            }
        }

        if (isset($data->{'allOf'})) {
            $values = [];

            foreach ($data->{'allOf'} as $value) {
                $values[] = $this->normalizerChain->denormalize($value, 'Joli\Jane\Swagger\Model\Schema', 'json', $context);
            }

            $object->setAllOf($values);
        }

        if (isset($data->{'properties'})) {
            $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);

            foreach ($data->{'properties'} as $key => $value) {
                $values[$key] = $this->normalizerChain->denormalize($value, 'Joli\Jane\Swagger\Model\Schema', 'json', $context);
            }

            $object->setProperties($values);
        }

        if (isset($data->{'discriminator'})) {
            $object->setDiscriminator($data->{'discriminator'});
        }

        if (isset($data->{'readOnly'})) {
            $object->setReadOnly($data->{'readOnly'});
        }

        if (isset($data->{'xml'})) {
            $object->setXml($this->normalizerChain->denormalize($data->{'xml'}, 'Joli\Jane\Swagger\Model\Xml', 'json', $context));
        }

        if (isset($data->{'externalDocs'})) {
            $object->setExternalDocs($this->normalizerChain->denormalize($data->{'externalDocs'}, 'Joli\Jane\Swagger\Model\ExternalDocs', 'json', $context));
        }

        if (isset($data->{'example'})) {
            $object->setExample($data->{'example'});
        }

        return $object;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\Jane\Swagger\Model\Schema') {
            return false;
        }

        if ($format !== 'json') {
            return false;
        }

        return true;
    }
}
