<?php

namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class InfoNormalizer implements DenormalizerInterface
{
    public $normalizerChain;
    public function setNormalizerChain(NormalizerChain $normalizerChain)
    {
        $this->normalizerChain = $normalizerChain;
    }
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\Swagger\\Model\\Info') {
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
        $object = new \Joli\Jane\Swagger\Model\Info();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (isset($data->{'title'})) {
            $object->setTitle($data->{'title'});
        }
        if (isset($data->{'version'})) {
            $object->setVersion($data->{'version'});
        }
        if (isset($data->{'description'})) {
            $object->setDescription($data->{'description'});
        }
        if (isset($data->{'termsOfService'})) {
            $object->setTermsOfService($data->{'termsOfService'});
        }
        if (isset($data->{'contact'})) {
            $object->setContact($this->normalizerChain->denormalize($data->{'contact'}, 'Joli\\Jane\\Swagger\\Model\\Contact', 'json', $context));
        }
        if (isset($data->{'license'})) {
            $object->setLicense($this->normalizerChain->denormalize($data->{'license'}, 'Joli\\Jane\\Swagger\\Model\\License', 'json', $context));
        }

        return $object;
    }
}
