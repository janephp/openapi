<?php
namespace Joli\Jane\Swagger\Model;

class Schema
{
    /**
     * @var string
     */
    protected $dollarRef;

    /**
     * @var string
     */
    protected $format;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var mixed
     */
    protected $default;

    /**
     * @var float
     */
    protected $multipleOf;

    /**
     * @var float
     */
    protected $maximum;

    /**
     * @var bool
     */
    protected $exclusiveMaximum;

    /**
     * @var float
     */
    protected $minimum;

    /**
     * @var bool
     */
    protected $exclusiveMinimum;

    /**
     * @var int
     */
    protected $maxLength;

    /**
     * @var int|mixed
     */
    protected $minLength;

    /**
     * @var string
     */
    protected $pattern;

    /**
     * @var int
     */
    protected $maxItems;

    /**
     * @var int|mixed
     */
    protected $minItems;

    /**
     * @var bool
     */
    protected $uniqueItems;

    /**
     * @var int
     */
    protected $maxProperties;

    /**
     * @var int|mixed
     */
    protected $minProperties;

    /**
     * @var string[]
     */
    protected $required;

    /**
     * @var array
     */
    protected $enum;

    /**
     * @var \Joli\Jane\Swagger\Model\Schema|bool
     */
    protected $additionalProperties;

    /**
     * @var mixed|mixed[]
     */
    protected $type;

    /**
     * @var \Joli\Jane\Swagger\Model\Schema|\Joli\Jane\Swagger\Model\Schema[]
     */
    protected $items;

    /**
     * @var \Joli\Jane\Swagger\Model\Schema[]
     */
    protected $allOf;

    /**
     * @var \Joli\Jane\Swagger\Model\Schema[]
     */
    protected $properties;

    /**
     * @var string
     */
    protected $discriminator;

    /**
     * @var bool
     */
    protected $readOnly;

    /**
     * @var \Joli\Jane\Swagger\Xml
     */
    protected $xml;

    /**
     * @var \Joli\Jane\Swagger\Model\ExternalDocs
     */
    protected $externalDocs;

    /**
     * @var mixed
     */
    protected $example;

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
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param string $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
     * @return mixed
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @param mixed $default
     */
    public function setDefault($default)
    {
        $this->default = $default;
    }

    /**
     * @return float
     */
    public function getMultipleOf()
    {
        return $this->multipleOf;
    }

    /**
     * @param float $multipleOf
     */
    public function setMultipleOf($multipleOf)
    {
        $this->multipleOf = $multipleOf;
    }

    /**
     * @return float
     */
    public function getMaximum()
    {
        return $this->maximum;
    }

    /**
     * @param float $maximum
     */
    public function setMaximum($maximum)
    {
        $this->maximum = $maximum;
    }

    /**
     * @return bool
     */
    public function getExclusiveMaximum()
    {
        return $this->exclusiveMaximum;
    }

    /**
     * @param bool $exclusiveMaximum
     */
    public function setExclusiveMaximum($exclusiveMaximum)
    {
        $this->exclusiveMaximum = $exclusiveMaximum;
    }

    /**
     * @return float
     */
    public function getMinimum()
    {
        return $this->minimum;
    }

    /**
     * @param float $minimum
     */
    public function setMinimum($minimum)
    {
        $this->minimum = $minimum;
    }

    /**
     * @return bool
     */
    public function getExclusiveMinimum()
    {
        return $this->exclusiveMinimum;
    }

    /**
     * @param bool $exclusiveMinimum
     */
    public function setExclusiveMinimum($exclusiveMinimum)
    {
        $this->exclusiveMinimum = $exclusiveMinimum;
    }

    /**
     * @return int
     */
    public function getMaxLength()
    {
        return $this->maxLength;
    }

    /**
     * @param int $maxLength
     */
    public function setMaxLength($maxLength)
    {
        $this->maxLength = $maxLength;
    }

    /**
     * @return int|mixed
     */
    public function getMinLength()
    {
        return $this->minLength;
    }

    /**
     * @param int|mixed $minLength
     */
    public function setMinLength($minLength)
    {
        $this->minLength = $minLength;
    }

    /**
     * @return string
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * @param string $pattern
     */
    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
    }

    /**
     * @return int
     */
    public function getMaxItems()
    {
        return $this->maxItems;
    }

    /**
     * @param int $maxItems
     */
    public function setMaxItems($maxItems)
    {
        $this->maxItems = $maxItems;
    }

    /**
     * @return int|mixed
     */
    public function getMinItems()
    {
        return $this->minItems;
    }

    /**
     * @param int|mixed $minItems
     */
    public function setMinItems($minItems)
    {
        $this->minItems = $minItems;
    }

    /**
     * @return bool
     */
    public function getUniqueItems()
    {
        return $this->uniqueItems;
    }

    /**
     * @param bool $uniqueItems
     */
    public function setUniqueItems($uniqueItems)
    {
        $this->uniqueItems = $uniqueItems;
    }

    /**
     * @return int
     */
    public function getMaxProperties()
    {
        return $this->maxProperties;
    }

    /**
     * @param int $maxProperties
     */
    public function setMaxProperties($maxProperties)
    {
        $this->maxProperties = $maxProperties;
    }

    /**
     * @return int|mixed
     */
    public function getMinProperties()
    {
        return $this->minProperties;
    }

    /**
     * @param int|mixed $minProperties
     */
    public function setMinProperties($minProperties)
    {
        $this->minProperties = $minProperties;
    }

    /**
     * @return string[]
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * @param string[] $required
     */
    public function setRequired($required)
    {
        $this->required = $required;
    }

    /**
     * @return array
     */
    public function getEnum()
    {
        return $this->enum;
    }

    /**
     * @param array $enum
     */
    public function setEnum(array $enum)
    {
        $this->enum = $enum;
    }

    /**
     * @return \Joli\Jane\Swagger\Model\Schema|bool
     */
    public function getAdditionalProperties()
    {
        return $this->additionalProperties;
    }

    /**
     * @param Schema|bool $additionalProperties
     */
    public function setAdditionalProperties($additionalProperties)
    {
        $this->additionalProperties = $additionalProperties;
    }

    /**
     * @return mixed|mixed[]
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed|mixed[] $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return \Joli\Jane\Swagger\Model\Schema|\Joli\Jane\Swagger\Model\Schema[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param Schema[] $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

    /**
     * @return \Joli\Jane\Swagger\Model\Schema[]
     */
    public function getAllOf()
    {
        return $this->allOf;
    }

    /**
     * @param Schema[] $allOf
     */
    public function setAllOf($allOf)
    {
        $this->allOf = $allOf;
    }

    /**
     * @return \Joli\Jane\Swagger\Model\Schema[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param Schema[] $properties
     */
    public function setProperties($properties)
    {
        $this->properties = $properties;
    }

    /**
     * @return string
     */
    public function getDiscriminator()
    {
        return $this->discriminator;
    }

    /**
     * @param string $discriminator
     */
    public function setDiscriminator($discriminator)
    {
        $this->discriminator = $discriminator;
    }

    /**
     * @return bool
     */
    public function getReadOnly()
    {
        return $this->readOnly;
    }

    /**
     * @param bool $readOnly
     */
    public function setReadOnly($readOnly)
    {
        $this->readOnly = $readOnly;
    }

    /**
     * @return \Joli\Jane\Swagger\Xml
     */
    public function getXml()
    {
        return $this->xml;
    }

    /**
     * @param Xml $xml
     */
    public function setXml(Xml $xml)
    {
        $this->xml = $xml;
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
     * @return mixed
     */
    public function getExample()
    {
        return $this->example;
    }

    /**
     * @param mixed $example
     */
    public function setExample($example)
    {
        $this->example = $example;
    }
}
