<?php

namespace App\Apps\ToDo\Domain\Contract;

use App\Apps\ToDo\Application\Collection\ToDoCollection;
use App\Scalar\ValueObject\Boolean\BooleanValue;
use App\Scalar\ValueObject\DateTime\DateTime;
use App\Scalar\ValueObject\String\StringLiteral;

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
