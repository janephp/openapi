<?php

namespace Joli\Jane\OpenApi\Tests\Expected\Normalizer;

class NormalizerFactory
{
    public static function create()
    {
        $normalizers   = [];
        $normalizers[] = new SchemaNormalizer();
        $normalizers[] = new SchemaobjectPropertyNormalizer();

        return $normalizers;
    }
}
