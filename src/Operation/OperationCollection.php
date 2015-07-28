<?php

namespace Joli\Jane\Swagger\Operation;

class OperationCollection extends \ArrayObject
{
    /**
     * @param Operation $operation
     *
     * @return self
     */
    public function addOperation(Operation $operation)
    {
        $id = $operation->getMethod().$operation->getPath();

        if ($operation->getOperation()->getOperationId()) {
            $id = $operation->getOperation()->getOperationId();
        }

        $this[$id] = $operation;

        return $this;
    }

    /**
     * @return Operation[]
     */
    public function getOperations()
    {
        return iterator_to_array($this->getIterator());
    }

    /**
     * @param $id
     *
     * @return Operation|null
     */
    public function getOperation($id)
    {
        if (!isset($this[$id])) {
            return null;
        }

        return $this[$id];
    }
} 
