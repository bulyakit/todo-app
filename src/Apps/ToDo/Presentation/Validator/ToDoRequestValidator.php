<?php

namespace App\Apps\ToDo\Presentation\Validator;

use App\Apps\ToDo\Presentation\Exception\InvalidRequestException;

/**
 * Class ToDoRequestValidator
 */
class ToDoRequestValidator extends BaseValidator
{
    /**
     * @param array $params
     *
     * @throws InvalidRequestException
     */
    public function validateAdd(array $params)
    {
        $this->isValidRequest($params, [
            [BaseValidator::FIELD => 'taskName', BaseValidator::CALLBACK => [$this, 'isValidStringLiteral']],
            [BaseValidator::FIELD => 'dateTime', BaseValidator::CALLBACK => [$this, 'isValidDateTime']],
        ]);
    }
}