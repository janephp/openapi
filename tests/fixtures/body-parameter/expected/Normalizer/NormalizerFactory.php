<?php

namespace Joli\Jane\Swagger\Tests\Expected\Normalizer;

use Joli\Jane\Normalizer\NormalizerArray;
use Joli\Jane\Normalizer\ReferenceNormalizer;

class NormalizerFactory
{
    public static function create()
    {
        $normalizers   = [];
        $normalizers[] = new ReferenceNormalizer();
        $normalizers[] = new NormalizerArray();
        $normalizers[] = new SchemaNormalizer();
        $normalizers[] = new ObjectPropertyNormalizer();

        return $normalizers;
    }
}
