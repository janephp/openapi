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
        $id    = $operation->getMethod().$operation->getPath();
        $group = 0;

        if ($operation->getOperation()->getOperationId()) {
            $id = $operation->getOperation()->getOperationId();
        }

        if ($operation->getOperation()->getTags() !== null && count($operation->getOperation()->getTags()) > 0) {
            $group = $operation->getOperation()->getTags()[0];
        }

        if (!isset($this[$group])) {
            $this[$group] = [];
        }

        $this[$group][$id] = $operation;

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
     * @param $group
     *
     * @return Operation|null
     */
    public function getOperation($id, $group = 0)
    {
        if (!isset($this[$group][$id])) {
            return null;
        }

        return $this[$group][$id];
    }
} 
