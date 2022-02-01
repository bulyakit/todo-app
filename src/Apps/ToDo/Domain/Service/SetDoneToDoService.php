<?php

namespace App\Apps\ToDo\Domain\Service;

use App\Apps\ToDo\Infrastructure\Persistence\Repository\ToDoRepository;

/**
 * Class SetDoneToDoService
 */
class SetDoneToDoService
{
    /**
     * @var ToDoRepository
     */
    private ToDoRepository $repository;

    /**
     * SetDoneToDoService constructor.
     *
     * @param ToDoRepository $repository
     */
    public function __construct(ToDoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return void
     */
    public function set(int $toDoId)
    {
        $this->repository->setDone($toDoId);
    }
}
