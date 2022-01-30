<?php

namespace App\Apps\ToDo\Infrastructure\Persistence\Factory;

use App\Apps\ToDo\Domain\Aggregate\ToDo;

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
            $repositoryRow['name']
        );
    }
}
