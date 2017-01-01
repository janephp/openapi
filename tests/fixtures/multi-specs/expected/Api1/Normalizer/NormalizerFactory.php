<?php

namespace Joli\Jane\OpenApi\Tests\Expected\Api1\Normalizer;

class NormalizerFactory
{
    public static function create()
    {
        $normalizers   = [];
        $normalizers[] = new \Joli\Jane\Runtime\Normalizer\ArrayDenormalizer();
        $normalizers[] = new BodyNormalizer();

        return $normalizers;
    }
}
