<?php

namespace App\Scalar\Collection;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use JsonSerializable;
use App\Scalar\Exception\InvalidCollectionItemException;
use Traversable;

/**
 * Class AbstractCollection
 *
 * @package Livita\Scalar
 */
abstract class AbstractCollection implements IteratorAggregate, Countable, JsonSerializable
{
    /**
     * @var array
     */
    protected array $items = [];

    /**
     * @var string|null
     */
    protected ?string $type;

    /**
     * HashMap constructor.
     *
     * @param array $items
     *
     * @throws InvalidCollectionItemException
     */
    public function __construct(array $items = [])
    {
        $this->addAll($items);
    }

    /**
     * Clears items.
     */
    public function clear()
    {
        $this->items = [];
    }

    /**
     * @return AbstractCollection|Collection|HashMap
     *
     * @throws InvalidCollectionItemException
     */
    public function copy()
    {
        return new static($this->items);
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return count($this->items) == 0;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->items;
    }

    /**
     * @return ArrayIterator|Traversable
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * @param array $items
     *
     * @throws InvalidCollectionItemException
     */
    abstract public function addAll(array $items);

    /**
     * @param mixed $item
     *
     * @throws InvalidCollectionItemException
     */
    protected function isValidType($item)
    {
        if ($this->type && !($item instanceof $this->type)) {
            throw new InvalidCollectionItemException(
                'Invalid item type [type: ' . gettype($item) . ', required: ' . $this->type . ']'
            );
        }
    }
}
