<?php

namespace App\Apps\ToDo\Domain\Service;

use App\Apps\ToDo\Infrastructure\Persistence\Repository\ToDoRepository;
use App\Scalar\ValueObject\Boolean\BooleanValue;
use App\Scalar\ValueObject\DateTime\DateTime;
use App\Scalar\ValueObject\String\StringLiteral;

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
