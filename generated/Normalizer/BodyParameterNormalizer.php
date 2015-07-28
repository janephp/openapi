<?php
namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Joli\Jane\Swagger\Normalizer\NormalizerChain;

class BodyParameterNormalizer implements DenormalizerInterface
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

        $object = new \Joli\Jane\Swagger\Model\BodyParameter();

        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }

        if (isset($data->{'description'})) {
            $object->setDescription($data->{'description'});
        }

        if (isset($data->{'name'})) {
            $object->setName($data->{'name'});
        }

        if (isset($data->{'in'})) {
            $object->setIn($data->{'in'});
        }

        if (isset($data->{'required'})) {
            $object->setRequired($data->{'required'});
        }

        if (isset($data->{'schema'})) {
            $object->setSchema($this->normalizerChain->denormalize($data->{'schema'}, 'Joli\Jane\Swagger\Model\Schema', 'json', $context));
        }

        return $object;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\Jane\Swagger\Model\BodyParameter') {
            return false;
        }

        if ($format !== 'json') {
            return false;
        }

        return true;
    }
}
