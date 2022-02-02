<?php

namespace App\Apps\ToDo\Domain\Service;

use App\Apps\ToDo\Domain\Contract\ToDoRepositoryInterface;

/**
 * Class SetDoneToDoService
 */
class SetDoneToDoService
{
    /**
     * @var ToDoRepositoryInterface
     */
    private ToDoRepositoryInterface $repository;

    /**
     * SetDoneToDoService constructor.
     *
     * @param ToDoRepositoryInterface $repository
     */
    public function __construct(ToDoRepositoryInterface $repository)
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
