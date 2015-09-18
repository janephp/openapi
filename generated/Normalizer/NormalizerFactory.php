<?php

namespace Joli\Jane\Swagger\Normalizer;

class NormalizerFactory
{
    public static function create()
    {
        $normalizers = array();
        $normalizers[] = new SwaggerNormalizer();
        $normalizers[] = new InfoNormalizer();
        $normalizers[] = new ContactNormalizer();
        $normalizers[] = new LicenseNormalizer();
        $normalizers[] = new ExternalDocsNormalizer();
        $normalizers[] = new OperationNormalizer();
        $normalizers[] = new PathItemNormalizer();
        $normalizers[] = new ResponseNormalizer();
        $normalizers[] = new HeaderNormalizer();
        $normalizers[] = new BodyParameterNormalizer();
        $normalizers[] = new HeaderParameterSubSchemaNormalizer();
        $normalizers[] = new QueryParameterSubSchemaNormalizer();
        $normalizers[] = new FormDataParameterSubSchemaNormalizer();
        $normalizers[] = new PathParameterSubSchemaNormalizer();
        $normalizers[] = new SchemaNormalizer();
        $normalizers[] = new PrimitivesItemsNormalizer();
        $normalizers[] = new XmlNormalizer();
        $normalizers[] = new TagNormalizer();
        $normalizers[] = new BasicAuthenticationSecurityNormalizer();
        $normalizers[] = new ApiKeySecurityNormalizer();
        $normalizers[] = new Oauth2ImplicitSecurityNormalizer();
        $normalizers[] = new Oauth2PasswordSecurityNormalizer();
        $normalizers[] = new Oauth2ApplicationSecurityNormalizer();
        $normalizers[] = new Oauth2AccessCodeSecurityNormalizer();

        return $normalizers;
    }
}
