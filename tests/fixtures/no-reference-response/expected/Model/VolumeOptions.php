<?php

namespace Joli\Jane\OpenApi\Tests\Expected\Model;

class VolumeOptions
{
    /**
     * @var bool
     */
    protected $noCopy;
    /**
     * @var string[]
     */
    protected $labels;
    /**
     * @var DriverConfig
     */
    protected $driverConfig;

    /**
     * @return bool
     */
    public function getNoCopy()
    {
        return $this->noCopy;
    }

    /**
     * @param bool $noCopy
     *
     * @return self
     */
    public function setNoCopy($noCopy = null)
    {
        $this->noCopy = $noCopy;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getLabels()
    {
        return $this->labels;
    }

    /**
     * @param string[] $labels
     *
     * @return self
     */
    public function setLabels(\ArrayObject $labels = null)
    {
        $this->labels = $labels;

        return $this;
    }

    /**
     * @return DriverConfig
     */
    public function getDriverConfig()
    {
        return $this->driverConfig;
    }

    /**
     * @param DriverConfig $driverConfig
     *
     * @return self
     */
    public function setDriverConfig(DriverConfig $driverConfig = null)
    {
        $this->driverConfig = $driverConfig;

        return $this;
    }
}
