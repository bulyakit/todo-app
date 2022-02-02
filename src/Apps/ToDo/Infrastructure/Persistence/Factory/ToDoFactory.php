<?php

namespace App\Apps\ToDo\Infrastructure\Persistence\Factory;

use App\Apps\ToDo\Domain\Aggregate\ToDo;
use DateTime;

/**
 * Class ToDoFactory
 */
class ToDoFactory
{
    /**
     * @param array $repositoryRow
     *
     * @return ToDo
     */
    public function create(array $repositoryRow): ToDo
    {
        return new ToDo(
            (int)$repositoryRow['id'],
            $repositoryRow['task_name'],
            DateTime::createFromFormat('Y-m-d H:i:s', $repositoryRow['datetime']),
            (bool)$repositoryRow['is_done'],
            DateTime::createFromFormat('Y-m-d H:i:s', $repositoryRow['created_at']),
        );
    }
}
