<?php

namespace Joli\Jane\Swagger\Model;

class Operation
{
    /**
     * @var string[]
     */
    protected $tags;
    /**
     * @var string
     */
    protected $summary;
    /**
     * @var string
     */
    protected $description;
    /**
     * @var ExternalDocs
     */
    protected $externalDocs;
    /**
     * @var string
     */
    protected $operationId;
    /**
     * @var string[]
     */
    protected $produces;
    /**
     * @var string[]
     */
    protected $consumes;
    /**
     * @var \Joli\Jane\Swagger\Parameters[]|\Joli\Jane\Swagger\Parameters[]|\Joli\Jane\Swagger\Parameters[]|\Joli\Jane\Swagger\Parameters[]|\Joli\Jane\Swagger\Parameters[]
     */
    protected $parameters;
    /**
     * @var \Joli\Jane\Swagger\Responses[]|mixed[]
     */
    protected $responses;
    /**
     * @var string[]
     */
    protected $schemes;
    /**
     * @var bool
     */
    protected $deprecated;
    /**
     * @var string[][][]
     */
    protected $security;
    /**
     * @return string[]
     */
    public function getTags()
    {
        return $this->tags;
    }
    /**
     * @param string[] $tags
     *
     * @return self
     */
    public function setTags($tags = null)
    {
        $this->tags = $tags;

        return $this;
    }
    /**
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }
    /**
     * @param string $summary
     *
     * @return self
     */
    public function setSummary($summary = null)
    {
        $this->summary = $summary;

        return $this;
    }
    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }
    /**
     * @return ExternalDocs
     */
    public function getExternalDocs()
    {
        return $this->externalDocs;
    }
    /**
     * @param ExternalDocs $externalDocs
     *
     * @return self
     */
    public function setExternalDocs($externalDocs = null)
    {
        $this->externalDocs = $externalDocs;

        return $this;
    }
    /**
     * @return string
     */
    public function getOperationId()
    {
        return $this->operationId;
    }
    /**
     * @param string $operationId
     *
     * @return self
     */
    public function setOperationId($operationId = null)
    {
        $this->operationId = $operationId;

        return $this;
    }
    /**
     * @return string[]
     */
    public function getProduces()
    {
        return $this->produces;
    }
    /**
     * @param string[] $produces
     *
     * @return self
     */
    public function setProduces($produces = null)
    {
        $this->produces = $produces;

        return $this;
    }
    /**
     * @return string[]
     */
    public function getConsumes()
    {
        return $this->consumes;
    }
    /**
     * @param string[] $consumes
     *
     * @return self
     */
    public function setConsumes($consumes = null)
    {
        $this->consumes = $consumes;

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
    /**
     * @return \Joli\Jane\Swagger\Responses[]|mixed[]
     */
    public function getResponses()
    {
        return $this->responses;
    }
    /**
     * @param \Joli\Jane\Swagger\Responses[]|mixed[] $responses
     *
     * @return self
     */
    public function setResponses($responses = null)
    {
        $this->responses = $responses;

        return $this;
    }
    /**
     * @return string[]
     */
    public function getSchemes()
    {
        return $this->schemes;
    }
    /**
     * @param string[] $schemes
     *
     * @return self
     */
    public function setSchemes($schemes = null)
    {
        $this->schemes = $schemes;

        return $this;
    }
    /**
     * @return bool
     */
    public function getDeprecated()
    {
        return $this->deprecated;
    }
    /**
     * @param bool $deprecated
     *
     * @return self
     */
    public function setDeprecated($deprecated = null)
    {
        $this->deprecated = $deprecated;

        return $this;
    }
    /**
     * @return string[][][]
     */
    public function getSecurity()
    {
        return $this->security;
    }
    /**
     * @param string[][][] $security
     *
     * @return self
     */
    public function setSecurity($security = null)
    {
        $this->security = $security;

        return $this;
    }
}
