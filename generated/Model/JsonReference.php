<?php

namespace Joli\Jane\Swagger\Model;

class JsonReference
{
    /**
     * @var string
     */
    protected $dollarRef;
    /**
     * @return string
     */
    public function getDollarRef()
    {
        return $this->dollarRef;
    }
    /**
     * @param string $dollarRef
     *
     * @return self
     */
    public function setDollarRef($dollarRef)
    {
        $this->dollarRef = $dollarRef;

        return $this;
    }
}
