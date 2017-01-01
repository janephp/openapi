<?php

namespace Joli\Jane\OpenApi\Tests\Expected\Api2\Normalizer;

class NormalizerFactory
{
    public static function create()
    {
        $normalizers   = [];
        $normalizers[] = new \Joli\Jane\Runtime\Normalizer\ArrayDenormalizer();

        return $normalizers;
    }
}
