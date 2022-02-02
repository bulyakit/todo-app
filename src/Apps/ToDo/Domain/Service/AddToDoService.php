<?php

namespace App\Apps\ToDo\Domain\Service;

use App\Apps\ToDo\Domain\Contract\ToDoRepositoryInterface;
use DateTime;

/**
 * Class AddToDoService
 */
class AddToDoService
{
    /**
     * @var ToDoRepositoryInterface
     */
    private ToDoRepositoryInterface $repository;

    /**
     * AddToDoService constructor.
     *
     * @param ToDoRepositoryInterface $repository
     */
    public function __construct(ToDoRepositoryInterface $repository)
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
