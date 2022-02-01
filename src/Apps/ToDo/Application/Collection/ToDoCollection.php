<?php

namespace App\Apps\ToDo\Application\Collection;

use App\Apps\ToDo\Domain\Aggregate\ToDo;
use App\Collection\HashMap;

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
