<?php

namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class SwaggerNormalizer implements DenormalizerInterface
{
    public $normalizerChain;
    public function setNormalizerChain(NormalizerChain $normalizerChain)
    {
        $this->normalizerChain = $normalizerChain;
    }
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\Swagger\\Model\\Swagger') {
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
        $object = new \Joli\Jane\Swagger\Model\Swagger();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (isset($data->{'swagger'})) {
            $object->setSwagger($data->{'swagger'});
        }
        if (isset($data->{'info'})) {
            $object->setInfo($this->normalizerChain->denormalize($data->{'info'}, 'Joli\\Jane\\Swagger\\Model\\Info', 'json', $context));
        }
        if (isset($data->{'host'})) {
            $object->setHost($data->{'host'});
        }
        if (isset($data->{'basePath'})) {
            $object->setBasePath($data->{'basePath'});
        }
        if (isset($data->{'schemes'})) {
            $values = array();
            foreach ($data->{'schemes'} as $value) {
                $values[] = $value;
            }
            $object->setSchemes($values);
        }
        if (isset($data->{'consumes'})) {
            $values_0 = array();
            foreach ($data->{'consumes'} as $value_1) {
                $values_0[] = $value_1;
            }
            $object->setConsumes($values_0);
        }
        if (isset($data->{'produces'})) {
            $values_2 = array();
            foreach ($data->{'produces'} as $value_3) {
                $values_2[] = $value_3;
            }
            $object->setProduces($values_2);
        }
        if (isset($data->{'paths'})) {
            $values_4 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'paths'} as $key => $value_5) {
                if (preg_match('/^x-/', $key)) {
                    $values_4[$key] = $value_5;
                    continue;
                }
                if (preg_match('/^\//', $key)) {
                    $values_4[$key] = $this->normalizerChain->denormalize($value_5, 'Joli\\Jane\\Swagger\\Model\\PathItem', 'json', $context);
                    continue;
                }
            }
            $object->setPaths($values_4);
        }
        if (isset($data->{'definitions'})) {
            $values_67 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'definitions'} as $key_68 => $value_69) {
                $values_67[$key_68] = $this->normalizerChain->denormalize($value_69, 'Joli\\Jane\\Swagger\\Model\\Schema', 'json', $context);
            }
            $object->setDefinitions($values_67);
        }
        if (isset($data->{'parameters'})) {
            $values_70 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'parameters'} as $key_71 => $value_72) {
                $value_73 = $value_72;
                if (is_object($value_72) and $value_72->{'in'} == 'body') {
                    $value_73 = $this->normalizerChain->denormalize($value_72, 'Joli\\Jane\\Swagger\\Model\\BodyParameter', 'json', $context);
                } elseif (isset($value_72)) {
                    $value_74 = $value_72;
                    if (is_object($value_72) and $value_72->{'in'} == 'header' and ($value_72->{'type'} == 'string' or $value_72->{'type'} == 'number' or $value_72->{'type'} == 'boolean' or $value_72->{'type'} == 'integer' or $value_72->{'type'} == 'array')) {
                        $value_74 = $this->normalizerChain->denormalize($value_72, 'Joli\\Jane\\Swagger\\Model\\HeaderParameterSubSchema', 'json', $context);
                    } elseif (is_object($value_72) and $value_72->{'in'} == 'formData' and ($value_72->{'type'} == 'string' or $value_72->{'type'} == 'number' or $value_72->{'type'} == 'boolean' or $value_72->{'type'} == 'integer' or $value_72->{'type'} == 'array' or $value_72->{'type'} == 'file')) {
                        $value_74 = $this->normalizerChain->denormalize($value_72, 'Joli\\Jane\\Swagger\\Model\\FormDataParameterSubSchema', 'json', $context);
                    } elseif (is_object($value_72) and $value_72->{'in'} == 'query' and ($value_72->{'type'} == 'string' or $value_72->{'type'} == 'number' or $value_72->{'type'} == 'boolean' or $value_72->{'type'} == 'integer' or $value_72->{'type'} == 'array')) {
                        $value_74 = $this->normalizerChain->denormalize($value_72, 'Joli\\Jane\\Swagger\\Model\\QueryParameterSubSchema', 'json', $context);
                    } elseif (is_object($value_72) and $value_72->{'in'} == 'path' and ($value_72->{'type'} == 'string' or $value_72->{'type'} == 'number' or $value_72->{'type'} == 'boolean' or $value_72->{'type'} == 'integer' or $value_72->{'type'} == 'array')) {
                        $value_74 = $this->normalizerChain->denormalize($value_72, 'Joli\\Jane\\Swagger\\Model\\PathParameterSubSchema', 'json', $context);
                    }
                    $value_73 = $value_74;
                }
                $values_70[$key_71] = $value_73;
            }
            $object->setParameters($values_70);
        }
        if (isset($data->{'responses'})) {
            $values_75 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'responses'} as $key_76 => $value_77) {
                $values_75[$key_76] = $this->normalizerChain->denormalize($value_77, 'Joli\\Jane\\Swagger\\Model\\Response', 'json', $context);
            }
            $object->setResponses($values_75);
        }
        if (isset($data->{'security'})) {
            $values_78 = array();
            foreach ($data->{'security'} as $value_79) {
                $values_80 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
                foreach ($value_79 as $key_81 => $value_82) {
                    $values_83 = array();
                    foreach ($value_82 as $value_84) {
                        $values_83[] = $value_84;
                    }
                    $values_80[$key_81] = $values_83;
                }
                $values_78[] = $values_80;
            }
            $object->setSecurity($values_78);
        }
        if (isset($data->{'securityDefinitions'})) {
            $values_85 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'securityDefinitions'} as $key_86 => $value_87) {
                $value_88 = $value_87;
                if (is_object($value_87) and $value_87->{'type'} == 'basic') {
                    $value_88 = $this->normalizerChain->denormalize($value_87, 'Joli\\Jane\\Swagger\\Model\\BasicAuthenticationSecurity', 'json', $context);
                } elseif (is_object($value_87) and $value_87->{'type'} == 'apiKey' and ($value_87->{'in'} == 'header' or $value_87->{'in'} == 'query')) {
                    $value_88 = $this->normalizerChain->denormalize($value_87, 'Joli\\Jane\\Swagger\\Model\\ApiKeySecurity', 'json', $context);
                } elseif (is_object($value_87) and $value_87->{'type'} == 'oauth2' and $value_87->{'flow'} == 'implicit') {
                    $value_88 = $this->normalizerChain->denormalize($value_87, 'Joli\\Jane\\Swagger\\Model\\Oauth2ImplicitSecurity', 'json', $context);
                } elseif (is_object($value_87) and $value_87->{'type'} == 'oauth2' and $value_87->{'flow'} == 'password') {
                    $value_88 = $this->normalizerChain->denormalize($value_87, 'Joli\\Jane\\Swagger\\Model\\Oauth2PasswordSecurity', 'json', $context);
                } elseif (is_object($value_87) and $value_87->{'type'} == 'oauth2' and $value_87->{'flow'} == 'application') {
                    $value_88 = $this->normalizerChain->denormalize($value_87, 'Joli\\Jane\\Swagger\\Model\\Oauth2ApplicationSecurity', 'json', $context);
                } elseif (is_object($value_87) and $value_87->{'type'} == 'oauth2' and $value_87->{'flow'} == 'accessCode') {
                    $value_88 = $this->normalizerChain->denormalize($value_87, 'Joli\\Jane\\Swagger\\Model\\Oauth2AccessCodeSecurity', 'json', $context);
                }
                $values_85[$key_86] = $value_88;
            }
            $object->setSecurityDefinitions($values_85);
        }
        if (isset($data->{'tags'})) {
            $values_101 = array();
            foreach ($data->{'tags'} as $value_102) {
                $values_101[] = $this->normalizerChain->denormalize($value_102, 'Joli\\Jane\\Swagger\\Model\\Tag', 'json', $context);
            }
            $object->setTags($values_101);
        }
        if (isset($data->{'externalDocs'})) {
            $object->setExternalDocs($this->normalizerChain->denormalize($data->{'externalDocs'}, 'Joli\\Jane\\Swagger\\Model\\ExternalDocs', 'json', $context));
        }

        return $object;
    }
}
