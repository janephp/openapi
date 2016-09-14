<?php

namespace Joli\Jane\OpenApi\Tests\Expected\Model;

class Inherited1
{
    /**
     * @var string
     */
    protected $inheritedProperty1;

    /**
     * @return string
     */
    public function getInheritedProperty1()
    {
        return $this->inheritedProperty1;
    }

    /**
     * @param string $inheritedProperty1
     *
     * @return self
     */
    public function setInheritedProperty1($inheritedProperty1 = null)
    {
        $this->inheritedProperty1 = $inheritedProperty1;

        return $this;
    }
}
