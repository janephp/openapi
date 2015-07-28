<?php
namespace Joli\Jane\Swagger\Model;

class PathItem
{
    /**
     * @var string
     */
    protected $dollarRef;

    /**
     * @var \Joli\Jane\Swagger\Model\Operation
     */
    protected $get;

    /**
     * @var \Joli\Jane\Swagger\Model\Operation
     */
    protected $put;

    /**
     * @var \Joli\Jane\Swagger\Model\Operation
     */
    protected $post;

    /**
     * @var \Joli\Jane\Swagger\Model\Operation
     */
    protected $delete;

    /**
     * @var \Joli\Jane\Swagger\Model\Operation
     */
    protected $options;

    /**
     * @var \Joli\Jane\Swagger\Model\Operation
     */
    protected $head;

    /**
     * @var \Joli\Jane\Swagger\Model\Operation
     */
    protected $patch;

    /**
     * @var \Joli\Jane\Swagger\Parameters[]|array[]
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
     */
    public function setDollarRef($dollarRef)
    {
        $this->dollarRef = $dollarRef;
    }

    /**
     * @return \Joli\Jane\Swagger\Model\Operation
     */
    public function getGet()
    {
        return $this->get;
    }

    /**
     * @param Operation $get
     */
    public function setGet(Operation $get)
    {
        $this->get = $get;
    }

    /**
     * @return \Joli\Jane\Swagger\Model\Operation
     */
    public function getPut()
    {
        return $this->put;
    }

    /**
     * @param Operation $put
     */
    public function setPut(Operation $put)
    {
        $this->put = $put;
    }

    /**
     * @return \Joli\Jane\Swagger\Model\Operation
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param Operation $post
     */
    public function setPost(Operation $post)
    {
        $this->post = $post;
    }

    /**
     * @return \Joli\Jane\Swagger\Model\Operation
     */
    public function getDelete()
    {
        return $this->delete;
    }

    /**
     * @param Operation $delete
     */
    public function setDelete(Operation $delete)
    {
        $this->delete = $delete;
    }

    /**
     * @return \Joli\Jane\Swagger\Model\Operation
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param Operation $options
     */
    public function setOptions(Operation $options)
    {
        $this->options = $options;
    }

    /**
     * @return \Joli\Jane\Swagger\Model\Operation
     */
    public function getHead()
    {
        return $this->head;
    }

    /**
     * @param Operation $head
     */
    public function setHead(Operation $head)
    {
        $this->head = $head;
    }

    /**
     * @return \Joli\Jane\Swagger\Model\Operation
     */
    public function getPatch()
    {
        return $this->patch;
    }

    /**
     * @param Operation $patch
     */
    public function setPatch(Operation $patch)
    {
        $this->patch = $patch;
    }

    /**
     * @return \Joli\Jane\Swagger\Parameters[]|array[]
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param Parameters[]|array[] $parameters
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }
}
