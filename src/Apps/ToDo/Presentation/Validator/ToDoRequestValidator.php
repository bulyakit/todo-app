<?php

namespace App\Apps\ToDo\Presentation\Validator;

/**
 * Class ToDoRequestValidator
 */
class ToDoRequestValidator extends BaseValidator
{
    /**
     * @param array $params
     */
    public function validateAdd(array $params)
    {
        $this->isValidString('taskName', $params);
        $this->isValidDateTime('dateTime', $params);
    }

    /**
     * @param array $params
     */
    public function validateSetDone(array $params)
    {
        $this->isValidInteger('id', $params);
    }
}
