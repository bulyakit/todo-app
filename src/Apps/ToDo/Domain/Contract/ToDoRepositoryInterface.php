<?php

namespace App\Apps\ToDo\Domain\Contract;

use App\Apps\ToDo\Application\Collection\ToDoCollection;
use DateTime;

/**
 * interface ToDoRepositoryInterface
 */
interface ToDoRepositoryInterface
{
    /**
     * @param string $taskName
     * @param DateTime $dateTime
     *
     * @return int
     */
    public function add(string $taskName, DateTime $dateTime): int;

    /**
     * @return ToDoCollection
     */
    public function getAll(): ToDoCollection;

    /**
     * @param int $toDoId
     *
     * @return mixed
     */
    public function setDone(int $toDoId);
}
