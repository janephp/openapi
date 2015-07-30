<?php

namespace Joli\Jane\Swagger\Model;

class PathItem
{
    /**
     * @var string
     */
    protected $dollarRef;
    /**
     * @var Operation
     */
    protected $get;
    /**
     * @var Operation
     */
    protected $put;
    /**
     * @var Operation
     */
    protected $post;
    /**
     * @var Operation
     */
    protected $delete;
    /**
     * @var Operation
     */
    protected $options;
    /**
     * @var Operation
     */
    protected $head;
    /**
     * @var Operation
     */
    protected $patch;
    /**
     * @var \Joli\Jane\Swagger\Parameters[]|\Joli\Jane\Swagger\Parameters[]|\Joli\Jane\Swagger\Parameters[]|\Joli\Jane\Swagger\Parameters[]|\Joli\Jane\Swagger\Parameters[]
     */
    protected $parameters;
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
    public function setDollarRef($dollarRef = null)
    {
        $this->dollarRef = $dollarRef;

        return $this;
    }
    /**
     * @return Operation
     */
    public function getGet()
    {
        return $this->get;
    }
    /**
     * @param Operation $get
     *
     * @return self
     */
    public function setGet($get = null)
    {
        $this->get = $get;

        return $this;
    }
    /**
     * @return Operation
     */
    public function getPut()
    {
        return $this->put;
    }
    /**
     * @param Operation $put
     *
     * @return self
     */
    public function setPut($put = null)
    {
        $this->put = $put;

        return $this;
    }
    /**
     * @return Operation
     */
    public function getPost()
    {
        return $this->post;
    }
    /**
     * @param Operation $post
     *
     * @return self
     */
    public function setPost($post = null)
    {
        $this->post = $post;

        return $this;
    }
    /**
     * @return Operation
     */
    public function getDelete()
    {
        return $this->delete;
    }
    /**
     * @param Operation $delete
     *
     * @return self
     */
    public function setDelete($delete = null)
    {
        $this->delete = $delete;

        return $this;
    }
    /**
     * @return Operation
     */
    public function getOptions()
    {
        return $this->options;
    }
    /**
     * @param Operation $options
     *
     * @return self
     */
    public function setOptions($options = null)
    {
        $this->options = $options;

        return $this;
    }
    /**
     * @return Operation
     */
    public function getHead()
    {
        return $this->head;
    }
    /**
     * @param Operation $head
     *
     * @return self
     */
    public function setHead($head = null)
    {
        $this->head = $head;

        return $this;
    }
    /**
     * @return Operation
     */
    public function getPatch()
    {
        return $this->patch;
    }
    /**
     * @param Operation $patch
     *
     * @return self
     */
    public function setPatch($patch = null)
    {
        $this->patch = $patch;

        return $this;
    }
    /**
     * @return \Joli\Jane\Swagger\Parameters[]|\Joli\Jane\Swagger\Parameters[]|\Joli\Jane\Swagger\Parameters[]|\Joli\Jane\Swagger\Parameters[]|\Joli\Jane\Swagger\Parameters[]
     */
    public function getParameters()
    {
        return $this->parameters;
    }
    /**
     * @param \Joli\Jane\Swagger\Parameters[]|\Joli\Jane\Swagger\Parameters[]|\Joli\Jane\Swagger\Parameters[]|\Joli\Jane\Swagger\Parameters[]|\Joli\Jane\Swagger\Parameters[] $parameters
     *
     * @return self
     */
    public function setParameters($parameters = null)
    {
        $this->parameters = $parameters;

        return $this;
    }
}
