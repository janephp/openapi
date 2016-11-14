<?php

namespace Joli\Jane\OpenApi\Tests\Expected\Model;

class TestBodyParameterWithObjectSchemaTypeBody
{
    /**
     * @var string
     */
    protected $exampleProperty;

    /**
     * @return string
     */
    public function getExampleProperty()
    {
        return $this->exampleProperty;
    }

    /**
     * @param string $exampleProperty
     *
     * @return self
     */
    public function setExampleProperty($exampleProperty = null)
    {
        $this->exampleProperty = $exampleProperty;

        return $this;
    }
}
