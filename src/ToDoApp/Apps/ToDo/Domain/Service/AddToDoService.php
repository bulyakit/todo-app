<?php

namespace ToDoApp\Apps\ToDo\Domain\Service;

use ToDoApp\Apps\ToDo\Infrastructure\Persistence\Repository\ToDoRepository;
use ToDoApp\Scalar\ValueObject\Boolean\BooleanValue;
use ToDoApp\Scalar\ValueObject\DateTime\DateTime;
use ToDoApp\Scalar\ValueObject\String\StringLiteral;

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
     * GetAllUserService constructor.
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
    public function add(StringLiteral $taskName, DateTime $dateTime, BooleanValue $isDone)
    {
        $this->repository->add($taskName, $dateTime, $isDone);
    }
}
