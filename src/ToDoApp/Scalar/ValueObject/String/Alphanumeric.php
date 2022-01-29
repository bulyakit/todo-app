<?php

namespace ToDoApp\Scalar\ValueObject\String;

use ToDoApp\Scalar\Exception\InvalidStringException;

/**
 * Class Alphanumeric
 *
 * @package ToDoApp\Scalar
 */
class Alphanumeric extends StringLiteral
{
    /**
     * @param mixed $value
     *
     * @throws InvalidStringException
     */
    public static function validate($value)
    {
        parent::validate($value);

        if (!ctype_alnum($value)) {
            throw new InvalidStringException('Invalid alphanumeric string [value: ' . $value . ']');
        }
    }
}
