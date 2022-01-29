<?php

namespace ToDoApp\Apps\ToDo\Domain\Contract;

use ToDoApp\Apps\ToDo\Application\Collection\ToDoCollection;
use ToDoApp\Scalar\ValueObject\Boolean\BooleanValue;
use ToDoApp\Scalar\ValueObject\DateTime\DateTime;
use ToDoApp\Scalar\ValueObject\String\StringLiteral;

/**
 * interface ToDoRepositoryInterface
 */
interface ToDoRepositoryInterface
{
    /**
     * @param StringLiteral $taskName
     * @param DateTime $dateTime
     * @param BooleanValue $isDone
     *
     * @return mixed
     */
    public function add(StringLiteral $taskName, DateTime $dateTime, BooleanValue $isDone);

    /**
     * @return ToDoCollection
     */
    public function getAll(): ToDoCollection;
}
