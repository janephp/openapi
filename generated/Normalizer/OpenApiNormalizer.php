<?php

namespace Joli\Jane\OpenApi\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\SerializerAwareNormalizer;

class OpenApiNormalizer extends SerializerAwareNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\\Jane\\OpenApi\\Model\\OpenApi') {
            return false;
        }

        return true;
    }

    public function supportsNormalization($data, $format = null)
    {
        if ($data instanceof \Joli\Jane\OpenApi\Model\OpenApi) {
            return true;
        }

        return false;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (empty($data)) {
            return null;
        }
        if (isset($data->{'$ref'})) {
            return new Reference($data->{'$ref'}, $context['rootSchema'] ?: null);
        }
        $object = new \Joli\Jane\OpenApi\Model\OpenApi();
        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }
        if (isset($data->{'swagger'})) {
            $object->setSwagger($data->{'swagger'});
        }
        if (isset($data->{'info'})) {
            $object->setInfo($this->serializer->deserialize($data->{'info'}, 'Joli\\Jane\\OpenApi\\Model\\Info', 'raw', $context));
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
            $values_0 = [];
            foreach ($data->{'consumes'} as $value_1) {
                $values_0[] = $value_1;
            }
            $object->setConsumes($values_0);
        }
        if (isset($data->{'produces'})) {
            $values_2 = [];
            foreach ($data->{'produces'} as $value_3) {
                $values_2[] = $value_3;
            }
            $object->setProduces($values_2);
        }
        if (isset($data->{'paths'})) {
            $values_4 = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'paths'} as $key => $value_5) {
                if (preg_match('/^x-/', $key) && isset($value_5)) {
                    $values_4[$key] = $value_5;
                    continue;
                }
                if (preg_match('/^\//', $key) && is_object($value_5)) {
                    $values_4[$key] = $this->serializer->deserialize($value_5, 'Joli\\Jane\\OpenApi\\Model\\PathItem', 'raw', $context);
                    continue;
                }
            }
            $object->setPaths($values_4);
        }
        if (isset($data->{'definitions'})) {
            $values_6 = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'definitions'} as $key_8 => $value_7) {
                $values_6[$key_8] = $this->serializer->deserialize($value_7, 'Joli\\Jane\\OpenApi\\Model\\Schema', 'raw', $context);
            }
            $object->setDefinitions($values_6);
        }
        if (isset($data->{'parameters'})) {
            $values_9 = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'parameters'} as $key_11 => $value_10) {
                $value_12 = $value_10;
                if (is_object($value_10) and isset($value_10->{'name'}) and (isset($value_10->{'in'}) and $value_10->{'in'} == 'body') and isset($value_10->{'schema'})) {
                    $value_12 = $this->serializer->deserialize($value_10, 'Joli\\Jane\\OpenApi\\Model\\BodyParameter', 'raw', $context);
                }
                if (is_object($value_10) and (isset($value_10->{'in'}) and $value_10->{'in'} == 'header') and isset($value_10->{'name'}) and (isset($value_10->{'type'}) and ($value_10->{'type'} == 'string' or $value_10->{'type'} == 'number' or $value_10->{'type'} == 'boolean' or $value_10->{'type'} == 'integer' or $value_10->{'type'} == 'array'))) {
                    $value_12 = $this->serializer->deserialize($value_10, 'Joli\\Jane\\OpenApi\\Model\\HeaderParameterSubSchema', 'raw', $context);
                }
                if (is_object($value_10) and (isset($value_10->{'in'}) and $value_10->{'in'} == 'formData') and isset($value_10->{'name'}) and (isset($value_10->{'type'}) and ($value_10->{'type'} == 'string' or $value_10->{'type'} == 'number' or $value_10->{'type'} == 'boolean' or $value_10->{'type'} == 'integer' or $value_10->{'type'} == 'array' or $value_10->{'type'} == 'file'))) {
                    $value_12 = $this->serializer->deserialize($value_10, 'Joli\\Jane\\OpenApi\\Model\\FormDataParameterSubSchema', 'raw', $context);
                }
                if (is_object($value_10) and (isset($value_10->{'in'}) and $value_10->{'in'} == 'query') and isset($value_10->{'name'}) and (isset($value_10->{'type'}) and ($value_10->{'type'} == 'string' or $value_10->{'type'} == 'number' or $value_10->{'type'} == 'boolean' or $value_10->{'type'} == 'integer' or $value_10->{'type'} == 'array'))) {
                    $value_12 = $this->serializer->deserialize($value_10, 'Joli\\Jane\\OpenApi\\Model\\QueryParameterSubSchema', 'raw', $context);
                }
                if (is_object($value_10) and (isset($value_10->{'required'}) and $value_10->{'required'} == '1') and (isset($value_10->{'in'}) and $value_10->{'in'} == 'path') and isset($value_10->{'name'}) and (isset($value_10->{'type'}) and ($value_10->{'type'} == 'string' or $value_10->{'type'} == 'number' or $value_10->{'type'} == 'boolean' or $value_10->{'type'} == 'integer' or $value_10->{'type'} == 'array'))) {
                    $value_12 = $this->serializer->deserialize($value_10, 'Joli\\Jane\\OpenApi\\Model\\PathParameterSubSchema', 'raw', $context);
                }
                $values_9[$key_11] = $value_12;
            }
            $object->setParameters($values_9);
        }
        if (isset($data->{'responses'})) {
            $values_13 = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'responses'} as $key_15 => $value_14) {
                $values_13[$key_15] = $this->serializer->deserialize($value_14, 'Joli\\Jane\\OpenApi\\Model\\Response', 'raw', $context);
            }
            $object->setResponses($values_13);
        }
        if (isset($data->{'security'})) {
            $values_16 = [];
            foreach ($data->{'security'} as $value_17) {
                $values_18 = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
                foreach ($value_17 as $key_20 => $value_19) {
                    $values_21 = [];
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
            $values_23 = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);
            foreach ($data->{'securityDefinitions'} as $key_25 => $value_24) {
                $value_26 = $value_24;
                if (is_object($value_24) and (isset($value_24->{'type'}) and $value_24->{'type'} == 'basic')) {
                    $value_26 = $this->serializer->deserialize($value_24, 'Joli\\Jane\\OpenApi\\Model\\BasicAuthenticationSecurity', 'raw', $context);
                }
                if (is_object($value_24) and (isset($value_24->{'type'}) and $value_24->{'type'} == 'apiKey') and isset($value_24->{'name'}) and (isset($value_24->{'in'}) and ($value_24->{'in'} == 'header' or $value_24->{'in'} == 'query'))) {
                    $value_26 = $this->serializer->deserialize($value_24, 'Joli\\Jane\\OpenApi\\Model\\ApiKeySecurity', 'raw', $context);
                }
                if (is_object($value_24) and (isset($value_24->{'type'}) and $value_24->{'type'} == 'oauth2') and (isset($value_24->{'flow'}) and $value_24->{'flow'} == 'implicit') and isset($value_24->{'authorizationUrl'})) {
                    $value_26 = $this->serializer->deserialize($value_24, 'Joli\\Jane\\OpenApi\\Model\\Oauth2ImplicitSecurity', 'raw', $context);
                }
                if (is_object($value_24) and (isset($value_24->{'type'}) and $value_24->{'type'} == 'oauth2') and (isset($value_24->{'flow'}) and $value_24->{'flow'} == 'password') and isset($value_24->{'tokenUrl'})) {
                    $value_26 = $this->serializer->deserialize($value_24, 'Joli\\Jane\\OpenApi\\Model\\Oauth2PasswordSecurity', 'raw', $context);
                }
                if (is_object($value_24) and (isset($value_24->{'type'}) and $value_24->{'type'} == 'oauth2') and (isset($value_24->{'flow'}) and $value_24->{'flow'} == 'application') and isset($value_24->{'tokenUrl'})) {
                    $value_26 = $this->serializer->deserialize($value_24, 'Joli\\Jane\\OpenApi\\Model\\Oauth2ApplicationSecurity', 'raw', $context);
                }
                if (is_object($value_24) and (isset($value_24->{'type'}) and $value_24->{'type'} == 'oauth2') and (isset($value_24->{'flow'}) and $value_24->{'flow'} == 'accessCode') and isset($value_24->{'authorizationUrl'}) and isset($value_24->{'tokenUrl'})) {
                    $value_26 = $this->serializer->deserialize($value_24, 'Joli\\Jane\\OpenApi\\Model\\Oauth2AccessCodeSecurity', 'raw', $context);
                }
                $values_23[$key_25] = $value_26;
            }
            $object->setSecurityDefinitions($values_23);
        }
        if (isset($data->{'tags'})) {
            $values_27 = [];
            foreach ($data->{'tags'} as $value_28) {
                $values_27[] = $this->serializer->deserialize($value_28, 'Joli\\Jane\\OpenApi\\Model\\Tag', 'raw', $context);
            }
            $object->setTags($values_27);
        }
        if (isset($data->{'externalDocs'})) {
            $object->setExternalDocs($this->serializer->deserialize($data->{'externalDocs'}, 'Joli\\Jane\\OpenApi\\Model\\ExternalDocs', 'raw', $context));
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getSwagger()) {
            $data->{'swagger'} = $object->getSwagger();
        }
        if (null !== $object->getInfo()) {
            $data->{'info'} = $this->serializer->serialize($object->getInfo(), 'raw', $context);
        }
        if (null !== $object->getHost()) {
            $data->{'host'} = $object->getHost();
        }
        if (null !== $object->getBasePath()) {
            $data->{'basePath'} = $object->getBasePath();
        }
        if (null !== $object->getSchemes()) {
            $values_29 = [];
            foreach ($object->getSchemes() as $value_30) {
                $values_29[] = $value_30;
            }
            $data->{'schemes'} = $values_29;
        }
        if (null !== $object->getConsumes()) {
            $values_31 = [];
            foreach ($object->getConsumes() as $value_32) {
                $values_31[] = $value_32;
            }
            $data->{'consumes'} = $values_31;
        }
        if (null !== $object->getProduces()) {
            $values_33 = [];
            foreach ($object->getProduces() as $value_34) {
                $values_33[] = $value_34;
            }
            $data->{'produces'} = $values_33;
        }
        if (null !== $object->getPaths()) {
            $values_35 = new \stdClass();
            foreach ($object->getPaths() as $key_37 => $value_36) {
                if (preg_match('/^x-/', $key_37) && !is_null($value_36)) {
                    $values_35->{$key_37} = $value_36;
                    continue;
                }
                if (preg_match('/^\//', $key_37) && is_object($value_36)) {
                    $values_35->{$key_37} = $this->serializer->serialize($value_36, 'raw', $context);
                    continue;
                }
            }
            $data->{'paths'} = $values_35;
        }
        if (null !== $object->getDefinitions()) {
            $values_38 = new \stdClass();
            foreach ($object->getDefinitions() as $key_40 => $value_39) {
                $values_38->{$key_40} = $this->serializer->serialize($value_39, 'raw', $context);
            }
            $data->{'definitions'} = $values_38;
        }
        if (null !== $object->getParameters()) {
            $values_41 = new \stdClass();
            foreach ($object->getParameters() as $key_43 => $value_42) {
                $value_44 = $value_42;
                if (is_object($value_42)) {
                    $value_44 = $this->serializer->serialize($value_42, 'raw', $context);
                }
                if (is_object($value_42)) {
                    $value_44 = $this->serializer->serialize($value_42, 'raw', $context);
                }
                if (is_object($value_42)) {
                    $value_44 = $this->serializer->serialize($value_42, 'raw', $context);
                }
                if (is_object($value_42)) {
                    $value_44 = $this->serializer->serialize($value_42, 'raw', $context);
                }
                if (is_object($value_42)) {
                    $value_44 = $this->serializer->serialize($value_42, 'raw', $context);
                }
                $values_41->{$key_43} = $value_44;
            }
            $data->{'parameters'} = $values_41;
        }
        if (null !== $object->getResponses()) {
            $values_45 = new \stdClass();
            foreach ($object->getResponses() as $key_47 => $value_46) {
                $values_45->{$key_47} = $this->serializer->serialize($value_46, 'raw', $context);
            }
            $data->{'responses'} = $values_45;
        }
        if (null !== $object->getSecurity()) {
            $values_48 = [];
            foreach ($object->getSecurity() as $value_49) {
                $values_50 = new \stdClass();
                foreach ($value_49 as $key_52 => $value_51) {
                    $values_53 = [];
                    foreach ($value_51 as $value_54) {
                        $values_53[] = $value_54;
                    }
                    $values_50->{$key_52} = $values_53;
                }
                $values_48[] = $values_50;
            }
            $data->{'security'} = $values_48;
        }
        if (null !== $object->getSecurityDefinitions()) {
            $values_55 = new \stdClass();
            foreach ($object->getSecurityDefinitions() as $key_57 => $value_56) {
                $value_58 = $value_56;
                if (is_object($value_56)) {
                    $value_58 = $this->serializer->serialize($value_56, 'raw', $context);
                }
                if (is_object($value_56)) {
                    $value_58 = $this->serializer->serialize($value_56, 'raw', $context);
                }
                if (is_object($value_56)) {
                    $value_58 = $this->serializer->serialize($value_56, 'raw', $context);
                }
                if (is_object($value_56)) {
                    $value_58 = $this->serializer->serialize($value_56, 'raw', $context);
                }
                if (is_object($value_56)) {
                    $value_58 = $this->serializer->serialize($value_56, 'raw', $context);
                }
                if (is_object($value_56)) {
                    $value_58 = $this->serializer->serialize($value_56, 'raw', $context);
                }
                $values_55->{$key_57} = $value_58;
            }
            $data->{'securityDefinitions'} = $values_55;
        }
        if (null !== $object->getTags()) {
            $values_59 = [];
            foreach ($object->getTags() as $value_60) {
                $values_59[] = $this->serializer->serialize($value_60, 'raw', $context);
            }
            $data->{'tags'} = $values_59;
        }
        if (null !== $object->getExternalDocs()) {
            $data->{'externalDocs'} = $this->serializer->serialize($object->getExternalDocs(), 'raw', $context);
        }

        return $data;
    }
}
