<?php

namespace App\Apps\ToDo\Domain\Service;

use App\Apps\ToDo\Infrastructure\Persistence\Repository\ToDoRepository;
use DateTime;

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
     * @param string $taskName
     * @param DateTime $dateTime
     *
     * @return int
     */
    public function add(string $taskName, DateTime $dateTime): int
    {
        return $this->repository->add($taskName, $dateTime);
    }
}
