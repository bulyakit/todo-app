<?php

namespace App\Apps\ToDo\Application\Contract;

use App\Apps\ToDo\Application\Collection\ToDoCollection;

/**
 * Interface ToDoServiceInterface
 */
interface ToDoServiceInterface
{
    /**
     * @param string $taskName
     * @param \DateTime $dateTime
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
