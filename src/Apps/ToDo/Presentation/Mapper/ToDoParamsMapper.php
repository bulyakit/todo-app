<?php

namespace App\Apps\ToDo\Presentation\Mapper;

/**
 * Class ToDoParamsMapper
 */
class ToDoParamsMapper
{
    /**
     * @param array $params
     *
     * @return array
     *
     */
    public function mapAdd(array $params): array
    {
        return [
            $params['taskName'],
            \DateTime::createFromFormat('Y-m-d H:i:s', $params['dateTime']),
        ];
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function mapSetDone(array $params): array
    {
        return [
            $params['id'],
        ];
    }
}
