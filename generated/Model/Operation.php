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
     * @var \Joli\Jane\Swagger\Model\ExternalDocs
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
     * @var \Joli\Jane\Swagger\Parameters[]|array[]
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
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
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
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
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
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \Joli\Jane\Swagger\Model\ExternalDocs
     */
    public function getExternalDocs()
    {
        return $this->externalDocs;
    }

    /**
     * @param ExternalDocs $externalDocs
     */
    public function setExternalDocs(ExternalDocs $externalDocs)
    {
        $this->externalDocs = $externalDocs;
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
     */
    public function setOperationId($operationId)
    {
        $this->operationId = $operationId;
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
     */
    public function setProduces($produces)
    {
        $this->produces = $produces;
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
     */
    public function setConsumes($consumes)
    {
        $this->consumes = $consumes;
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

    /**
     * @return \Joli\Jane\Swagger\Responses[]|mixed[]
     */
    public function getResponses()
    {
        return $this->responses;
    }

    /**
     * @param Responses[]|mixed[] $responses
     */
    public function setResponses($responses)
    {
        $this->responses = $responses;
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
     */
    public function setSchemes($schemes)
    {
        $this->schemes = $schemes;
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
     */
    public function setDeprecated($deprecated)
    {
        $this->deprecated = $deprecated;
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
     */
    public function setSecurity($security)
    {
        $this->security = $security;
    }
}
