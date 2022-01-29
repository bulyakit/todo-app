<?php

namespace ToDoApp\Apps\ToDo\Application\Collection;

use ToDoApp\Apps\ToDo\Domain\Aggregate\ToDo;
use ToDoApp\Scalar\Collection\HashMap;

/**
 * Class ToDoCollection
 */
class ToDoCollection extends HashMap
{
    protected ?string $type = ToDo::class;

    public function remove(string $key)
    {
        unset($this->items[$key]);
    }
}
