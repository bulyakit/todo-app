<?php

namespace App\Scalar\Collection;

use App\Scalar\Exception\InvalidCollectionItemException;

/**
 * Class HashMap
 */
abstract class HashMap extends AbstractCollection
{
    /**
     * @param string $key
     *
     * @return bool
     */
    public function containsKey(string $key): bool
    {
        return array_key_exists($key, $this->items);
    }

    /**
     * @param string $key
     *
     * @return mixed|null
     */
    public function get(string $key)
    {
        return $this->containsKey($key) ? $this->items[$key] : null;
    }

    /**
     * @param string $key
     * @param mixed  $item
     *
     * @throws InvalidCollectionItemException
     */
    public function add(string $key, $item)
    {
        $this->isValidType($item);
        $this->items[$key] = $item;
    }

    /**
     * @param array $items
     *
     * @throws InvalidCollectionItemException
     */
    public function addAll(array $items)
    {
        foreach ($items as $key => $item) {
            $this->add($key, $item);
        }
    }
}
