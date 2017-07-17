<?php

namespace Joli\Jane\OpenApi\Tests\Expected\Normalizer;

class NormalizerFactory
{
    public static function create()
    {
        $normalizers   = [];
        $normalizers[] = new SwarmSpecNormalizer();
        $normalizers[] = new SwarmSpecOrchestrationNormalizer();
        $normalizers[] = new SwarmSpecRaftNormalizer();
        $normalizers[] = new SwarmSpecDispatcherNormalizer();
        $normalizers[] = new SwarmSpecCAConfigNormalizer();
        $normalizers[] = new SwarmSpecCAConfigExternalCAsItemNormalizer();
        $normalizers[] = new SwarmSpecEncryptionConfigNormalizer();
        $normalizers[] = new SwarmSpecTaskDefaultsNormalizer();
        $normalizers[] = new SwarmSpecTaskDefaultsLogDriverNormalizer();
        $normalizers[] = new SwarmInitBodyNormalizer();

        return $normalizers;
    }
}
