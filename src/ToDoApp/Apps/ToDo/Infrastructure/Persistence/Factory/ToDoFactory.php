<?php

namespace ToDoApp\Apps\Todo\Infrastructure\Persistence\Factory;


use ToDoApp\Apps\ToDo\Domain\Aggregate\ToDo;

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
