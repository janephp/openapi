<?php

namespace Joli\Jane\OpenApi\Tests\Expected\Normalizer;

class NormalizerFactory
{
    public static function create()
    {
        $normalizers   = [];
        $normalizers[] = new SwarmSpecNormalizer();
        $normalizers[] = new OrchestrationNormalizer();
        $normalizers[] = new RaftNormalizer();
        $normalizers[] = new DispatcherNormalizer();
        $normalizers[] = new CAConfigNormalizer();
        $normalizers[] = new EncryptionConfigNormalizer();
        $normalizers[] = new TaskDefaultsNormalizer();
        $normalizers[] = new LogDriverNormalizer();
        $normalizers[] = new SwarmInitBodyNormalizer();

        return $normalizers;
    }
}
