<?php
namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Joli\Jane\Swagger\Normalizer\NormalizerChain;

class ResponseNormalizer implements DenormalizerInterface
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

        $object = new \Joli\Jane\Swagger\Model\Response();

        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }

        if (isset($data->{'description'})) {
            $object->setDescription($data->{'description'});
        }

        if (isset($data->{'schema'})) {
            $object->setSchema($this->normalizerChain->denormalize($data->{'schema'}, 'Joli\Jane\Swagger\Model\Schema', 'json', $context));
        }

        if (isset($data->{'headers'})) {
            $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);

            foreach ($data->{'headers'} as $key => $value) {
                $values[$key] = $this->normalizerChain->denormalize($value, 'Joli\Jane\Swagger\Model\Header', 'json', $context);
            }

            $object->setHeaders($values);
        }

        if (isset($data->{'examples'})) {
            $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);

            foreach ($data->{'examples'} as $key => $value) {
                if (preg_match('/^[a-z0-9-]+\/[a-z0-9\-+]+$/', $key)) {
                    $values[$key] = $value;
                    continue;
                }
            }

            $object->setExamples($values);
        }

        return $object;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\Jane\Swagger\Model\Response') {
            return false;
        }

        if ($format !== 'json') {
            return false;
        }

        return true;
    }
}
