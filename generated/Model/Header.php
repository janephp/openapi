<?php
namespace Joli\Jane\Swagger\Model;

class Header
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $format;

    /**
     * @var \Joli\Jane\Swagger\Items
     */
    protected $items;

    /**
     * @var string
     */
    protected $collectionFormat;

    /**
     * @var mixed
     */
    protected $default;

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
     * @var array
     */
    protected $enum;

    /**
     * @var float
     */
    protected $multipleOf;

    /**
     * @var string
     */
    protected $description;

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
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
     * @return \Joli\Jane\Swagger\Items
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param Items $items
     */
    public function setItems(Items $items)
    {
        $this->items = $items;
    }

    /**
     * @return string
     */
    public function getCollectionFormat()
    {
        return $this->collectionFormat;
    }

    /**
     * @param string $collectionFormat
     */
    public function setCollectionFormat($collectionFormat)
    {
        $this->collectionFormat = $collectionFormat;
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
}
