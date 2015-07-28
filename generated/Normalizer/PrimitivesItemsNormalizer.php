<?php
namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Joli\Jane\Swagger\Normalizer\NormalizerChain;

class PrimitivesItemsNormalizer implements DenormalizerInterface
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

        $object = new \Joli\Jane\Swagger\Model\PrimitivesItems();

        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }

        if (isset($data->{'type'})) {
            $object->setType($data->{'type'});
        }

        if (isset($data->{'format'})) {
            $object->setFormat($data->{'format'});
        }

        if (isset($data->{'items'})) {
            $object->setItems($this->normalizerChain->denormalize($data->{'items'}, 'Joli\Jane\Swagger\Model\PrimitivesItems', 'json', $context));
        }

        if (isset($data->{'collectionFormat'})) {
            $object->setCollectionFormat($data->{'collectionFormat'});
        }

        if (isset($data->{'default'})) {
            $object->setDefault($data->{'default'});
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

        if (isset($data->{'enum'})) {
            $object->setEnum($data->{'enum'});
        }

        if (isset($data->{'multipleOf'})) {
            $object->setMultipleOf($data->{'multipleOf'});
        }

        return $object;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\Jane\Swagger\Model\PrimitivesItems') {
            return false;
        }

        if ($format !== 'json') {
            return false;
        }

        return true;
    }
}
