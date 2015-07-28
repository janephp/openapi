<?php
namespace Joli\Jane\Swagger\Normalizer;

use Joli\Jane\Reference\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Joli\Jane\Swagger\Normalizer\NormalizerChain;

class OperationNormalizer implements DenormalizerInterface
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

        $object = new \Joli\Jane\Swagger\Model\Operation();

        if (!isset($context['rootSchema'])) {
            $context['rootSchema'] = $object;
        }

        if (isset($data->{'tags'})) {
            $values = [];

            foreach ($data->{'tags'} as $value) {
                $values[] = $value;
            }

            $object->setTags($values);
        }

        if (isset($data->{'summary'})) {
            $object->setSummary($data->{'summary'});
        }

        if (isset($data->{'description'})) {
            $object->setDescription($data->{'description'});
        }

        if (isset($data->{'externalDocs'})) {
            $object->setExternalDocs($this->normalizerChain->denormalize($data->{'externalDocs'}, 'Joli\Jane\Swagger\Model\ExternalDocs', 'json', $context));
        }

        if (isset($data->{'operationId'})) {
            $object->setOperationId($data->{'operationId'});
        }

        if (isset($data->{'produces'})) {
            $values = [];

            foreach ($data->{'produces'} as $value) {
                $values[] = $value;
            }

            $object->setProduces($values);
        }

        if (isset($data->{'consumes'})) {
            $values = [];

            foreach ($data->{'consumes'} as $value) {
                $values[] = $value;
            }

            $object->setConsumes($values);
        }

        if (isset($data->{'parameters'})) {
            $values = [];

            foreach ($data->{'parameters'} as $value) {
                $values[] = $value;
            }

            $object->setParameters($values);
        }

        if (isset($data->{'responses'})) {
            $values = new \ArrayObject([], \ArrayObject::ARRAY_AS_PROPS);

            foreach ($data->{'responses'} as $key => $value) {
                if (preg_match('/^([0-9]{3})$|^(default)$/', $key)) {
                    if (is_object($value)) {
                        $values[$key] = $this->normalizerChain->denormalize($value, 'Joli\Jane\Swagger\Model\Response', 'json', $context);
                    }

                    if (is_object($value)) {
                        $values[$key] = $this->normalizerChain->denormalize($value, 'Joli\Jane\Swagger\Model\JsonReference', 'json', $context);
                    }

                    continue;
                }

                if (preg_match('/^x-/', $key)) {
                    $values[$key] = $value;
                    continue;
                }
            }

            $object->setResponses($values);
        }

        if (isset($data->{'schemes'})) {
            $values = [];

            foreach ($data->{'schemes'} as $value) {
                $values[] = $value;
            }

            $object->setSchemes($values);
        }

        if (isset($data->{'deprecated'})) {
            $object->setDeprecated($data->{'deprecated'});
        }

        if (isset($data->{'security'})) {
            $values = [];

            foreach ($data->{'security'} as $value) {
                $values[] = $value;
            }

            $object->setSecurity($values);
        }

        return $object;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type !== 'Joli\Jane\Swagger\Model\Operation') {
            return false;
        }

        if ($format !== 'json') {
            return false;
        }

        return true;
    }
}
