<?php

namespace App\Apps\ToDo\Domain\Contract;

use App\Apps\ToDo\Application\Collection\ToDoCollection;

/**
 * interface ToDoRepositoryInterface
 */
interface ToDoRepositoryInterface
{
    /**
     * @param string $taskName
     * @param \DateTime $dateTime
     *
     * @return mixed
     */
    public function add(string $taskName, \DateTime $dateTime);

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
