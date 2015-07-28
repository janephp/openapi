<?php
namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Joli\Jane\Swagger\Normalizer\NormalizerChain;

class SwaggerNormalizer implements DenormalizerInterface
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

        $object = new \Joli\Jane\Swagger\Model\Swagger();

        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }

        if (isset($data->{'swagger'})) {
            $object->setSwagger($data->{'swagger'});
        }

        if (isset($data->{'info'})) {
            $object->setInfo($this->normalizerChain->denormalize($data->{'info'}, 'Joli\Jane\Swagger\Model\Info', 'json', $context));
        }

        if (isset($data->{'host'})) {
            $object->setHost($data->{'host'});
        }

        if (isset($data->{'basePath'})) {
            $object->setBasePath($data->{'basePath'});
        }

        if (isset($data->{'schemes'})) {
            $values = [];

            foreach ($data->{'schemes'} as $value) {
                $values[] = $value;
            }

            $object->setSchemes($values);
        }

        if (isset($data->{'consumes'})) {
            $values = [];

            foreach ($data->{'consumes'} as $value) {
                $values[] = $value;
            }

            $object->setConsumes($values);
        }

        if (isset($data->{'produces'})) {
            $values = [];

            foreach ($data->{'produces'} as $value) {
                $values[] = $value;
            }

            $object->setProduces($values);
        }

        if (isset($data->{'paths'})) {
            $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);

            foreach ($data->{'paths'} as $key => $value) {
                if (preg_match('/^x-/', $key)) {
                    $values[$key] = $value;
                    continue;
                }

                if (preg_match('/^\//', $key)) {
                    $values[$key] = $this->normalizerChain->denormalize($value, 'Joli\Jane\Swagger\Model\PathItem', 'json', $context);
                    continue;
                }
            }

            $object->setPaths($values);
        }

        if (isset($data->{'definitions'})) {
            $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);

            foreach ($data->{'definitions'} as $key => $value) {
                $values[$key] = $this->normalizerChain->denormalize($value, 'Joli\Jane\Swagger\Model\Schema', 'json', $context);
            }

            $object->setDefinitions($values);
        }

        if (isset($data->{'parameters'})) {
            $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);

            foreach ($data->{'parameters'} as $key => $value) {
                if (is_object($value)) {
                    $values[$key] = $this->normalizerChain->denormalize($value, 'Joli\Jane\Swagger\Model\BodyParameter', 'json', $context);
                }

                if (is_object($value)) {
                    $object->setParameters($data->{'parameters'});
                }
            }

            $object->setParameters($values);
        }

        if (isset($data->{'responses'})) {
            $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);

            foreach ($data->{'responses'} as $key => $value) {
                $values[$key] = $this->normalizerChain->denormalize($value, 'Joli\Jane\Swagger\Model\Response', 'json', $context);
            }

            $object->setResponses($values);
        }

        if (isset($data->{'security'})) {
            $values = [];

            foreach ($data->{'security'} as $value) {
                $values[] = $value;
            }

            $object->setSecurity($values);
        }

        if (isset($data->{'securityDefinitions'})) {
            $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);

            foreach ($data->{'securityDefinitions'} as $key => $value) {
                if (is_object($value)) {
                    $values[$key] = $this->normalizerChain->denormalize($value, 'Joli\Jane\Swagger\Model\BasicAuthenticationSecurity', 'json', $context);
                }

                if (is_object($value)) {
                    $values[$key] = $this->normalizerChain->denormalize($value, 'Joli\Jane\Swagger\Model\ApiKeySecurity', 'json', $context);
                }

                if (is_object($value)) {
                    $values[$key] = $this->normalizerChain->denormalize($value, 'Joli\Jane\Swagger\Model\Oauth2ImplicitSecurity', 'json', $context);
                }

                if (is_object($value)) {
                    $values[$key] = $this->normalizerChain->denormalize($value, 'Joli\Jane\Swagger\Model\Oauth2PasswordSecurity', 'json', $context);
                }

                if (is_object($value)) {
                    $values[$key] = $this->normalizerChain->denormalize($value, 'Joli\Jane\Swagger\Model\Oauth2ApplicationSecurity', 'json', $context);
                }

                if (is_object($value)) {
                    $values[$key] = $this->normalizerChain->denormalize($value, 'Joli\Jane\Swagger\Model\Oauth2AccessCodeSecurity', 'json', $context);
                }
            }

            $object->setSecurityDefinitions($values);
        }

        if (isset($data->{'tags'})) {
            $values = [];

            foreach ($data->{'tags'} as $value) {
                $values[] = $this->normalizerChain->denormalize($value, 'Joli\Jane\Swagger\Model\Tag', 'json', $context);
            }

            $object->setTags($values);
        }

        if (isset($data->{'externalDocs'})) {
            $object->setExternalDocs($this->normalizerChain->denormalize($data->{'externalDocs'}, 'Joli\Jane\Swagger\Model\ExternalDocs', 'json', $context));
        }

        return $object;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\Jane\Swagger\Model\Swagger') {
            return false;
        }

        if ($format !== 'json') {
            return false;
        }

        return true;
    }
}
