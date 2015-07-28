<?php
namespace Joli\Jane\Swagger\Normalizer;

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class NormalizerChain implements DenormalizerInterface
{
    private $normalizers = [];

    public function addNormalizer($normalizer)
    {
        $normalizer->setNormalizerChain($this);
        $this->normalizers[] = $normalizer;
    }

    public function denormalize($data, $class, $format = null, array $context = array())
    {
        foreach ($this->normalizers as $normalizer) {
            if ($normalizer->supportsDenormalization($data, $class, $format)) {
                return $normalizer->denormalize($data, $class, $format, $context);
            }
        }

        return null;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        foreach ($this->normalizers as $normalizer) {
            if ($normalizer->supportsDenormalization($data, $type, $format)) {
                return true;
            }
        }

        return false;
    }

    public static function build()
    {
        $normalizer = new self();

        $normalizer->addNormalizer(new ContactNormalizer());
        $normalizer->addNormalizer(new LicenseNormalizer());
        $normalizer->addNormalizer(new InfoNormalizer());
        $normalizer->addNormalizer(new ExternalDocsNormalizer());
        $normalizer->addNormalizer(new XmlNormalizer());
        $normalizer->addNormalizer(new SchemaNormalizer());
        $normalizer->addNormalizer(new PrimitivesItemsNormalizer());
        $normalizer->addNormalizer(new HeaderNormalizer());
        $normalizer->addNormalizer(new ResponseNormalizer());
        $normalizer->addNormalizer(new OperationNormalizer());
        $normalizer->addNormalizer(new PathItemNormalizer());
        $normalizer->addNormalizer(new BodyParameterNormalizer());
        $normalizer->addNormalizer(new BasicAuthenticationSecurityNormalizer());
        $normalizer->addNormalizer(new ApiKeySecurityNormalizer());
        $normalizer->addNormalizer(new Oauth2ImplicitSecurityNormalizer());
        $normalizer->addNormalizer(new Oauth2PasswordSecurityNormalizer());
        $normalizer->addNormalizer(new Oauth2ApplicationSecurityNormalizer());
        $normalizer->addNormalizer(new Oauth2AccessCodeSecurityNormalizer());
        $normalizer->addNormalizer(new SwaggerNormalizer());

        return $normalizer;
    }
}
