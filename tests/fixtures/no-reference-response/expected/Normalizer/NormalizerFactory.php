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
        $normalizers[] = new MountBindOptionsNormalizer();
        $normalizers[] = new MountVolumeOptionsNormalizer();
        $normalizers[] = new MountVolumeOptionsDriverConfigNormalizer();
        $normalizers[] = new MountTmpfsOptionsNormalizer();
        $normalizers[] = new RestartPolicyNormalizer();
        $normalizers[] = new ResourcesNormalizer();
        $normalizers[] = new ResourcesBlkioWeightDeviceItemNormalizer();
        $normalizers[] = new ResourcesUlimitsItemNormalizer();
        $normalizers[] = new HealthConfigNormalizer();
        $normalizers[] = new HostConfigNormalizer();
        $normalizers[] = new HostConfigLogConfigNormalizer();
        $normalizers[] = new HostConfigPortBindingsItemNormalizer();
        $normalizers[] = new ConfigNormalizer();
        $normalizers[] = new ConfigVolumesNormalizer();
        $normalizers[] = new EndpointSettingsNormalizer();
        $normalizers[] = new EndpointSettingsIPAMConfigNormalizer();
        $normalizers[] = new ContainersCreateBodyNormalizer();
        $normalizers[] = new ContainersCreateBodyNetworkingConfigNormalizer();
        $normalizers[] = new ContainersCreateResponse201Normalizer();

        return $normalizers;
    }
}
