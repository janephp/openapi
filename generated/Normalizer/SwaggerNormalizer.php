<?php

namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class SwaggerNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\Swagger\\Model\\Swagger') {
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
            $object->setInfo($this->serializer->deserialize($data->{'info'}, 'Joli\\Jane\\Swagger\\Model\\Info', 'raw', $context));
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
                if (preg_match('/^x-/', $key) && isset($value_5)) {
                    $values_4[$key] = $value_5;
                    continue;
                }
                if (preg_match('/^\//', $key) && is_object($value_5)) {
                    $values_4[$key] = $this->serializer->deserialize($value_5, 'Joli\\Jane\\Swagger\\Model\\PathItem', 'raw', $context);
                    continue;
                }
            }
            $object->setPaths($values_4);
        }
        if (isset($data->{'definitions'})) {
            $values_6 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'definitions'} as $key_8 => $value_7) {
                $values_6[$key_8] = $this->serializer->deserialize($value_7, 'Joli\\Jane\\Swagger\\Model\\Schema', 'raw', $context);
            }
            $object->setDefinitions($values_6);
        }
        if (isset($data->{'parameters'})) {
            $values_9 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'parameters'} as $key_11 => $value_10) {
                $value_12 = $value_10;
                if (is_object($value_10) and isset($value_10->{'name'}) and (isset($value_10->{'in'}) and $value_10->{'in'} == 'body') and isset($value_10->{'schema'})) {
                    $value_12 = $this->serializer->deserialize($value_10, 'Joli\\Jane\\Swagger\\Model\\BodyParameter', 'raw', $context);
                }
                if (is_object($value_10) and (isset($value_10->{'in'}) and $value_10->{'in'} == 'header') and isset($value_10->{'name'}) and (isset($value_10->{'type'}) and ($value_10->{'type'} == 'string' or $value_10->{'type'} == 'number' or $value_10->{'type'} == 'boolean' or $value_10->{'type'} == 'integer' or $value_10->{'type'} == 'array'))) {
                    $value_12 = $this->serializer->deserialize($value_10, 'Joli\\Jane\\Swagger\\Model\\HeaderParameterSubSchema', 'raw', $context);
                }
                if (is_object($value_10) and (isset($value_10->{'in'}) and $value_10->{'in'} == 'formData') and isset($value_10->{'name'}) and (isset($value_10->{'type'}) and ($value_10->{'type'} == 'string' or $value_10->{'type'} == 'number' or $value_10->{'type'} == 'boolean' or $value_10->{'type'} == 'integer' or $value_10->{'type'} == 'array' or $value_10->{'type'} == 'file'))) {
                    $value_12 = $this->serializer->deserialize($value_10, 'Joli\\Jane\\Swagger\\Model\\FormDataParameterSubSchema', 'raw', $context);
                }
                if (is_object($value_10) and (isset($value_10->{'in'}) and $value_10->{'in'} == 'query') and isset($value_10->{'name'}) and (isset($value_10->{'type'}) and ($value_10->{'type'} == 'string' or $value_10->{'type'} == 'number' or $value_10->{'type'} == 'boolean' or $value_10->{'type'} == 'integer' or $value_10->{'type'} == 'array'))) {
                    $value_12 = $this->serializer->deserialize($value_10, 'Joli\\Jane\\Swagger\\Model\\QueryParameterSubSchema', 'raw', $context);
                }
                if (is_object($value_10) and (isset($value_10->{'in'}) and $value_10->{'in'} == 'path') and isset($value_10->{'name'}) and (isset($value_10->{'type'}) and ($value_10->{'type'} == 'string' or $value_10->{'type'} == 'number' or $value_10->{'type'} == 'boolean' or $value_10->{'type'} == 'integer' or $value_10->{'type'} == 'array'))) {
                    $value_12 = $this->serializer->deserialize($value_10, 'Joli\\Jane\\Swagger\\Model\\PathParameterSubSchema', 'raw', $context);
                }
                $values_9[$key_11] = $value_12;
            }
            $object->setParameters($values_9);
        }
        if (isset($data->{'responses'})) {
            $values_13 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'responses'} as $key_15 => $value_14) {
                $values_13[$key_15] = $this->serializer->deserialize($value_14, 'Joli\\Jane\\Swagger\\Model\\Response', 'raw', $context);
            }
            $object->setResponses($values_13);
        }
        if (isset($data->{'security'})) {
            $values_16 = array();
            foreach ($data->{'security'} as $value_17) {
                $values_18 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
                foreach ($value_17 as $key_20 => $value_19) {
                    $values_21 = array();
                    foreach ($value_19 as $value_22) {
                        $values_21[] = $value_22;
                    }
                    $values_18[$key_20] = $values_21;
                }
                $values_16[] = $values_18;
            }
            $object->setSecurity($values_16);
        }
        if (isset($data->{'securityDefinitions'})) {
            $values_23 = new \ArrayObject(array(), \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'securityDefinitions'} as $key_25 => $value_24) {
                $value_26 = $value_24;
                if (is_object($value_24) and (isset($value_24->{'type'}) and $value_24->{'type'} == 'basic')) {
                    $value_26 = $this->serializer->deserialize($value_24, 'Joli\\Jane\\Swagger\\Model\\BasicAuthenticationSecurity', 'raw', $context);
                }
                if (is_object($value_24) and (isset($value_24->{'type'}) and $value_24->{'type'} == 'apiKey') and isset($value_24->{'name'}) and (isset($value_24->{'in'}) and ($value_24->{'in'} == 'header' or $value_24->{'in'} == 'query'))) {
                    $value_26 = $this->serializer->deserialize($value_24, 'Joli\\Jane\\Swagger\\Model\\ApiKeySecurity', 'raw', $context);
                }
                if (is_object($value_24) and (isset($value_24->{'type'}) and $value_24->{'type'} == 'oauth2') and (isset($value_24->{'flow'}) and $value_24->{'flow'} == 'implicit') and isset($value_24->{'authorizationUrl'})) {
                    $value_26 = $this->serializer->deserialize($value_24, 'Joli\\Jane\\Swagger\\Model\\Oauth2ImplicitSecurity', 'raw', $context);
                }
                if (is_object($value_24) and (isset($value_24->{'type'}) and $value_24->{'type'} == 'oauth2') and (isset($value_24->{'flow'}) and $value_24->{'flow'} == 'password') and isset($value_24->{'tokenUrl'})) {
                    $value_26 = $this->serializer->deserialize($value_24, 'Joli\\Jane\\Swagger\\Model\\Oauth2PasswordSecurity', 'raw', $context);
                }
                if (is_object($value_24) and (isset($value_24->{'type'}) and $value_24->{'type'} == 'oauth2') and (isset($value_24->{'flow'}) and $value_24->{'flow'} == 'application') and isset($value_24->{'tokenUrl'})) {
                    $value_26 = $this->serializer->deserialize($value_24, 'Joli\\Jane\\Swagger\\Model\\Oauth2ApplicationSecurity', 'raw', $context);
                }
                if (is_object($value_24) and (isset($value_24->{'type'}) and $value_24->{'type'} == 'oauth2') and (isset($value_24->{'flow'}) and $value_24->{'flow'} == 'accessCode') and isset($value_24->{'authorizationUrl'}) and isset($value_24->{'tokenUrl'})) {
                    $value_26 = $this->serializer->deserialize($value_24, 'Joli\\Jane\\Swagger\\Model\\Oauth2AccessCodeSecurity', 'raw', $context);
                }
                $values_23[$key_25] = $value_26;
            }
            $object->setSecurityDefinitions($values_23);
        }
        if (isset($data->{'tags'})) {
            $values_27 = array();
            foreach ($data->{'tags'} as $value_28) {
                $values_27[] = $this->serializer->deserialize($value_28, 'Joli\\Jane\\Swagger\\Model\\Tag', 'raw', $context);
            }
            $object->setTags($values_27);
        }
        if (isset($data->{'externalDocs'})) {
            $object->setExternalDocs($this->serializer->deserialize($data->{'externalDocs'}, 'Joli\\Jane\\Swagger\\Model\\ExternalDocs', 'raw', $context));
        }

        return $object;
    }
}
