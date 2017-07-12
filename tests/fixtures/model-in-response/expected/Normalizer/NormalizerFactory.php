<?php

namespace Joli\Jane\OpenApi\Tests\Expected\Normalizer;

class NormalizerFactory
{
    public static function create()
    {
        $normalizers   = [];
        $normalizers[] = new SchemaNormalizer();
        $normalizers[] = new ObjectPropertyNormalizer();
        $normalizers[] = new ErrorNormalizer();
        $normalizers[] = new TestIdResponse200Normalizer();

        return $normalizers;
    }
}
