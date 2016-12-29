<?php

namespace Joli\Jane\OpenApi\Tests\Expected\Model;

class Schema
{
    /**
     * @var string
     */
    protected $stringProperty;
    /**
     * @var int
     */
    protected $integerProperty;
    /**
     * @var float
     */
    protected $floatProperty;
    /**
     * @var mixed[]
     */
    protected $arrayProperty;
    /**
     * @var string[]
     */
    protected $mapProperty;
    /**
     * @var ObjectProperty
     */
    protected $objectProperty;
    /**
     * @var Schema
     */
    protected $objectRefProperty;
    /**
     * @var string
     */
    protected $inheritedProperty1;
    /**
     * @var string
     */
    protected $inheritedProperty2;

    /**
     * @return string
     */
    public function getStringProperty()
    {
        return $this->stringProperty;
    }

    /**
     * @param string $stringProperty
     *
     * @return self
     */
    public function setStringProperty($stringProperty = null)
    {
        $this->stringProperty = $stringProperty;

        return $this;
    }

    /**
     * @return int
     */
    public function getIntegerProperty()
    {
        return $this->integerProperty;
    }

    /**
     * @param int $integerProperty
     *
     * @return self
     */
    public function setIntegerProperty($integerProperty = null)
    {
        $this->integerProperty = $integerProperty;

        return $this;
    }

    /**
     * @return float
     */
    public function getFloatProperty()
    {
        return $this->floatProperty;
    }

    /**
     * @param float $floatProperty
     *
     * @return self
     */
    public function setFloatProperty($floatProperty = null)
    {
        $this->floatProperty = $floatProperty;

        return $this;
    }

    /**
     * @return mixed[]
     */
    public function getArrayProperty()
    {
        return $this->arrayProperty;
    }

    /**
     * @param mixed[] $arrayProperty
     *
     * @return self
     */
    public function setArrayProperty(array $arrayProperty = null)
    {
        $this->arrayProperty = $arrayProperty;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getMapProperty()
    {
        return $this->mapProperty;
    }

    /**
     * @param string[] $mapProperty
     *
     * @return self
     */
    public function setMapProperty(\ArrayObject $mapProperty = null)
    {
        $this->mapProperty = $mapProperty;

        return $this;
    }

    /**
     * @return ObjectProperty
     */
    public function getObjectProperty()
    {
        return $this->objectProperty;
    }

    /**
     * @param ObjectProperty $objectProperty
     *
     * @return self
     */
    public function setObjectProperty(ObjectProperty $objectProperty = null)
    {
        $this->objectProperty = $objectProperty;

        return $this;
    }

    /**
     * @return Schema
     */
    public function getObjectRefProperty()
    {
        return $this->objectRefProperty;
    }

    /**
     * @param Schema $objectRefProperty
     *
     * @return self
     */
    public function setObjectRefProperty(Schema $objectRefProperty = null)
    {
        $this->objectRefProperty = $objectRefProperty;

        return $this;
    }

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

    /**
     * @return string
     */
    public function getInheritedProperty2()
    {
        return $this->inheritedProperty2;
    }

    /**
     * @param string $inheritedProperty2
     *
     * @return self
     */
    public function setInheritedProperty2($inheritedProperty2 = null)
    {
        $this->inheritedProperty2 = $inheritedProperty2;

        return $this;
    }
}
