<?php

namespace App\Apps\ToDo\Presentation\Formatter;

use App\Apps\ToDo\Application\Collection\ToDoCollection;
use App\Apps\ToDo\Domain\Aggregate\ToDo;
use Exception;

/**
 * Class ToDoResponseFormatter
 */
class ToDoResponseFormatter
{
    /**
     * @param ToDo $toDo
     *
     * @return array
     *
     * @throws Exception
     */
    public function formatGet(ToDo $toDo): array
    {
        return [
            'taskName'  => $toDo->getTaskName(),
            'dateTime'  => $toDo->getDateTime()->format('Y-m-d H:i:s'),
            'isDone'    => $toDo->getIsDone(),
            'createdAt' => $toDo->getCreatedAt()->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * @param ToDoCollection $toDos
     *
     * @return array
     *
     * @throws Exception
     */
    public function formatGetAll(ToDoCollection $toDos): array
    {
        $response = [];

        foreach ($toDos as $toDo) {
            $response['todo'][] = $this->formatGet($toDo);
        }

        return $response;
    }
}
