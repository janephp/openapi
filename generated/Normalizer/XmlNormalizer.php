<?php
namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Joli\Jane\Swagger\Normalizer\NormalizerChain;

class XmlNormalizer implements DenormalizerInterface
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

        $object = new \Joli\Jane\Swagger\Model\Xml();

        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }

        if (isset($data->{'name'})) {
            $object->setName($data->{'name'});
        }

        if (isset($data->{'namespace'})) {
            $object->setNamespace($data->{'namespace'});
        }

        if (isset($data->{'prefix'})) {
            $object->setPrefix($data->{'prefix'});
        }

        if (isset($data->{'attribute'})) {
            $object->setAttribute($data->{'attribute'});
        }

        if (isset($data->{'wrapped'})) {
            $object->setWrapped($data->{'wrapped'});
        }

        return $object;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\Jane\Swagger\Model\Xml') {
            return false;
        }

        if ($format !== 'json') {
            return false;
        }

        return true;
    }
}
