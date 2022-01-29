<?php

namespace ToDoApp\Validator;

use ToDoApp\Exception\InvalidRequestException;

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
            [BaseValidator::FIELD => 'id', BaseValidator::CALLBACK => [$this, 'isValidUnsignedInteger']],
            [BaseValidator::FIELD => 'taskName', BaseValidator::CALLBACK => [$this, 'isValidStringLiteral']],
            [BaseValidator::FIELD => 'datetime', BaseValidator::CALLBACK => [$this, 'isValidDateTime']],
        ]);
    }
}
