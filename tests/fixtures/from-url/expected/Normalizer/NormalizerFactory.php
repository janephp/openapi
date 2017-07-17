<?php

namespace Joli\Jane\OpenApi\Tests\Expected\Normalizer;

class NormalizerFactory
{
    public static function create()
    {
        $normalizers   = [];
        $normalizers[] = new PetNormalizer();
        $normalizers[] = new ErrorNormalizer();

        return $normalizers;
    }
}
