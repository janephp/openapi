<?php

namespace Joli\Jane\Swagger\Model;

class Response
{
    /**
     * @var string
     */
    protected $description;
    /**
     * @var \Joli\Jane\Swagger\Schema
     */
    protected $schema;
    /**
     * @var \Joli\Jane\Swagger\Headers[]
     */
    protected $headers;
    /**
     * @var mixed[]
     */
    protected $examples;
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
     * @return \Joli\Jane\Swagger\Schema
     */
    public function getSchema()
    {
        return $this->schema;
    }
    /**
     * @param \Joli\Jane\Swagger\Schema $schema
     *
     * @return self
     */
    public function setSchema($schema = null)
    {
        $this->schema = $schema;

        return $this;
    }
    /**
     * @return \Joli\Jane\Swagger\Headers[]
     */
    public function getHeaders()
    {
        return $this->headers;
    }
    /**
     * @param \Joli\Jane\Swagger\Headers[] $headers
     *
     * @return self
     */
    public function setHeaders($headers = null)
    {
        $this->headers = $headers;

        return $this;
    }
    /**
     * @return mixed[]
     */
    public function getExamples()
    {
        return $this->examples;
    }
    /**
     * @param mixed[] $examples
     *
     * @return self
     */
    public function setExamples($examples = null)
    {
        $this->examples = $examples;

        return $this;
    }
}
