<?php

namespace Joli\Jane\OpenApi\Tests\Expected\Model;

class Mount
{
    /**
     * @var string
     */
    protected $target;
    /**
     * @var string
     */
    protected $source;
    /**
     * @var string
     */
    protected $type;
    /**
     * @var bool
     */
    protected $readOnly;
    /**
     * @var string
     */
    protected $consistency;
    /**
     * @var BindOptions
     */
    protected $bindOptions;
    /**
     * @var VolumeOptions
     */
    protected $volumeOptions;
    /**
     * @var TmpfsOptions
     */
    protected $tmpfsOptions;

    /**
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param string $target
     *
     * @return self
     */
    public function setTarget($target = null)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $source
     *
     * @return self
     */
    public function setSource($source = null)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return self
     */
    public function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return bool
     */
    public function getReadOnly()
    {
        return $this->readOnly;
    }

    /**
     * @param bool $readOnly
     *
     * @return self
     */
    public function setReadOnly($readOnly = null)
    {
        $this->readOnly = $readOnly;

        return $this;
    }

    /**
     * @return string
     */
    public function getConsistency()
    {
        return $this->consistency;
    }

    /**
     * @param string $consistency
     *
     * @return self
     */
    public function setConsistency($consistency = null)
    {
        $this->consistency = $consistency;

        return $this;
    }

    /**
     * @return BindOptions
     */
    public function getBindOptions()
    {
        return $this->bindOptions;
    }

    /**
     * @param BindOptions $bindOptions
     *
     * @return self
     */
    public function setBindOptions(BindOptions $bindOptions = null)
    {
        $this->bindOptions = $bindOptions;

        return $this;
    }

    /**
     * @return VolumeOptions
     */
    public function getVolumeOptions()
    {
        return $this->volumeOptions;
    }

    /**
     * @param VolumeOptions $volumeOptions
     *
     * @return self
     */
    public function setVolumeOptions(VolumeOptions $volumeOptions = null)
    {
        $this->volumeOptions = $volumeOptions;

        return $this;
    }

    /**
     * @return TmpfsOptions
     */
    public function getTmpfsOptions()
    {
        return $this->tmpfsOptions;
    }

    /**
     * @param TmpfsOptions $tmpfsOptions
     *
     * @return self
     */
    public function setTmpfsOptions(TmpfsOptions $tmpfsOptions = null)
    {
        $this->tmpfsOptions = $tmpfsOptions;

        return $this;
    }
}
