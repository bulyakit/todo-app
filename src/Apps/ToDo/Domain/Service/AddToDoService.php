<?php

namespace App\Apps\ToDo\Domain\Service;

use App\Apps\ToDo\Infrastructure\Persistence\Repository\ToDoRepository;

/**
 * Class AddToDoService
 */
class AddToDoService
{
    /**
     * @var ToDoRepository
     */
    private ToDoRepository $repository;

    /**
     * AddToDoService constructor.
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
    public function add(string $taskName, \DateTime $dateTime)
    {
        $this->repository->add($taskName, $dateTime);
    }
}
