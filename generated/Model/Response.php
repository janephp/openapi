<?php

namespace Joli\Jane\Swagger\Model;

class Response
{
    /**
     * @var string
     */
    protected $description;
    /**
     * @var Schema
     */
    protected $schema;
    /**
     * @var Header[]
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
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
    /**
     * @return Schema
     */
    public function getSchema()
    {
        return $this->schema;
    }
    /**
     * @param Schema $schema
     *
     * @return self
     */
    public function setSchema($schema)
    {
        $this->schema = $schema;

        return $this;
    }
    /**
     * @return Header[]
     */
    public function getHeaders()
    {
        return $this->headers;
    }
    /**
     * @param Header[] $headers
     *
     * @return self
     */
    public function setHeaders($headers)
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
    public function setExamples($examples)
    {
        $this->examples = $examples;

        return $this;
    }
}
