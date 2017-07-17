<?php

namespace Joli\Jane\OpenApi\Tests\Expected\Model;

class TaskDefaults
{
    /**
     * @var LogDriver
     */
    protected $logDriver;

    /**
     * @return LogDriver
     */
    public function getLogDriver()
    {
        return $this->logDriver;
    }

    /**
     * @param LogDriver $logDriver
     *
     * @return self
     */
    public function setLogDriver(LogDriver $logDriver = null)
    {
        $this->logDriver = $logDriver;

        return $this;
    }
}
