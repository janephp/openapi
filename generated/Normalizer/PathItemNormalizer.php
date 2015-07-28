<?php
namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Joli\Jane\Swagger\Normalizer\NormalizerChain;

class PathItemNormalizer implements DenormalizerInterface
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

        $object = new \Joli\Jane\Swagger\Model\PathItem();

        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }

        if (isset($data->{'$ref'})) {
            $object->setDollarRef($data->{'$ref'});
        }

        if (isset($data->{'get'})) {
            $object->setGet($this->normalizerChain->denormalize($data->{'get'}, 'Joli\Jane\Swagger\Model\Operation', 'json', $context));
        }

        if (isset($data->{'put'})) {
            $object->setPut($this->normalizerChain->denormalize($data->{'put'}, 'Joli\Jane\Swagger\Model\Operation', 'json', $context));
        }

        if (isset($data->{'post'})) {
            $object->setPost($this->normalizerChain->denormalize($data->{'post'}, 'Joli\Jane\Swagger\Model\Operation', 'json', $context));
        }

        if (isset($data->{'delete'})) {
            $object->setDelete($this->normalizerChain->denormalize($data->{'delete'}, 'Joli\Jane\Swagger\Model\Operation', 'json', $context));
        }

        if (isset($data->{'options'})) {
            $object->setOptions($this->normalizerChain->denormalize($data->{'options'}, 'Joli\Jane\Swagger\Model\Operation', 'json', $context));
        }

        if (isset($data->{'head'})) {
            $object->setHead($this->normalizerChain->denormalize($data->{'head'}, 'Joli\Jane\Swagger\Model\Operation', 'json', $context));
        }

        if (isset($data->{'patch'})) {
            $object->setPatch($this->normalizerChain->denormalize($data->{'patch'}, 'Joli\Jane\Swagger\Model\Operation', 'json', $context));
        }

        if (isset($data->{'parameters'})) {
            $values = [];

            foreach ($data->{'parameters'} as $value) {
                $values[] = $value;
            }

            $object->setParameters($values);
        }

        return $object;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\Jane\Swagger\Model\PathItem') {
            return false;
        }

        if ($format !== 'json') {
            return false;
        }

        return true;
    }
}
