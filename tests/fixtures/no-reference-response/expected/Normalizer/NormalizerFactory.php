<?php

namespace Joli\Jane\OpenApi\Tests\Expected\Normalizer;

class NormalizerFactory
{
    public static function create()
    {
        $normalizers   = [];
        $normalizers[] = new DeviceMappingNormalizer();
        $normalizers[] = new ThrottleDeviceNormalizer();
        $normalizers[] = new MountNormalizer();
        $normalizers[] = new BindOptionsNormalizer();
        $normalizers[] = new VolumeOptionsNormalizer();
        $normalizers[] = new DriverConfigNormalizer();
        $normalizers[] = new TmpfsOptionsNormalizer();
        $normalizers[] = new RestartPolicyNormalizer();
        $normalizers[] = new ResourcesNormalizer();
        $normalizers[] = new HealthConfigNormalizer();
        $normalizers[] = new ConfigNormalizer();
        $normalizers[] = new VolumesNormalizer();
        $normalizers[] = new EndpointSettingsNormalizer();
        $normalizers[] = new IPAMConfigNormalizer();
        $normalizers[] = new ContainersCreateResponse201Normalizer();

        return $normalizers;
    }
}
