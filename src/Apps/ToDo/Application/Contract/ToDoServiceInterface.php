<?php

namespace App\Apps\ToDo\Application\Contract;

use App\Apps\ToDo\Application\Collection\ToDoCollection;
use App\Scalar\ValueObject\Boolean\BooleanValue;
use App\Scalar\ValueObject\DateTime\DateTime;
use App\Scalar\ValueObject\String\StringLiteral;

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
