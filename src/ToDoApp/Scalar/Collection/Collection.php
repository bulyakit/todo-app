<?php

namespace ToDoApp\Scalar\Collection;

use ToDoApp\Scalar\Exception\InvalidCollectionItemException;

/**
 * Class Collection
 */
abstract class Collection extends AbstractCollection
{
    /**
     * @param mixed $item
     *
     * @throws InvalidCollectionItemException
     */
    public function add($item)
    {
        $this->isValidType($item);
        $this->items[] = $item;
    }

    /**
     * @param array $items
     *
     * @throws InvalidCollectionItemException
     */
    public function addAll(array $items)
    {
        foreach ($items as $item) {
            $this->add($item);
        }
    }
}
