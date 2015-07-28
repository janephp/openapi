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
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \Joli\Jane\Swagger\Schema
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * @param Schema $schema
     */
    public function setSchema(Schema $schema)
    {
        $this->schema = $schema;
    }

    /**
     * @return \Joli\Jane\Swagger\Headers[]
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param Headers[] $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
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
     */
    public function setExamples($examples)
    {
        $this->examples = $examples;
    }
}
