<?php
namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Joli\Jane\Swagger\Normalizer\NormalizerChain;

class Oauth2PasswordSecurityNormalizer implements DenormalizerInterface
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

        $object = new \Joli\Jane\Swagger\Model\Oauth2PasswordSecurity();

        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }

        if (isset($data->{'type'})) {
            $object->setType($data->{'type'});
        }

        if (isset($data->{'flow'})) {
            $object->setFlow($data->{'flow'});
        }

        if (isset($data->{'scopes'})) {
            $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);

            foreach ($data->{'scopes'} as $key => $value) {
                $values[$key] = $value;
            }

            $object->setScopes($values);
        }

        if (isset($data->{'tokenUrl'})) {
            $object->setTokenUrl($data->{'tokenUrl'});
        }

        if (isset($data->{'description'})) {
            $object->setDescription($data->{'description'});
        }

        return $object;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\Jane\Swagger\Model\Oauth2PasswordSecurity') {
            return false;
        }

        if ($format !== 'json') {
            return false;
        }

        return true;
    }
}
