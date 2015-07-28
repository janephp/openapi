<?php
namespace Joli\Jane\Swagger\Model;

class Xml
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $namespace;

    /**
     * @var string
     */
    protected $prefix;

    /**
     * @var bool
     */
    protected $attribute;

    /**
     * @var bool
     */
    protected $wrapped;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * @return bool
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @param bool $attribute
     */
    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
    }

    /**
     * @return bool
     */
    public function getWrapped()
    {
        return $this->wrapped;
    }

    /**
     * @param bool $wrapped
     */
    public function setWrapped($wrapped)
    {
        $this->wrapped = $wrapped;
    }
}
