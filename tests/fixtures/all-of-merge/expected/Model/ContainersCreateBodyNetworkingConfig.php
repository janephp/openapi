<?php

namespace Joli\Jane\OpenApi\Tests\Expected\Model;

class ContainersCreateBodyNetworkingConfig
{
    /**
     * @var EndpointSettings[]
     */
    protected $endpointsConfig;

    /**
     * @return EndpointSettings[]
     */
    public function getEndpointsConfig()
    {
        return $this->endpointsConfig;
    }

    /**
     * @param EndpointSettings[] $endpointsConfig
     *
     * @return self
     */
    public function setEndpointsConfig(\ArrayObject $endpointsConfig = null)
    {
        $this->endpointsConfig = $endpointsConfig;

        return $this;
    }
}
