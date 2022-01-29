<?php

namespace ToDoApp\Apps\ToDo\Application\Contract;

use ToDoApp\Apps\ToDo\Application\Collection\ToDoCollection;
use ToDoApp\Scalar\ValueObject\Boolean\BooleanValue;
use ToDoApp\Scalar\ValueObject\DateTime\DateTime;
use ToDoApp\Scalar\ValueObject\String\StringLiteral;

/**
 * Interface ToDoServiceInterface
 */
interface ToDoServiceInterface
{
    /**
     * @param StringLiteral $taskName
     *
     * @return mixed
     */
    /**
     * @param StringLiteral $taskName
     * @param DateTime $dateTime
     * @param BooleanValue $isDone
     */
    public function add(StringLiteral $taskName, DateTime $dateTime, BooleanValue $isDone);

    /**
     * @return ToDoCollection
     */
    public function getAll(): ToDoCollection;
}
