<?php

namespace App\Scalar\ValueObject\String;

use Scalar\Exception\InvalidStringException;

/**
 * Class StringLiteralMatch
 *
 * @package ToDoApp\Scalar
 */
class StringLiteralMatch extends StringLiteral
{
    /**
     * RegExp pattern for validation.
     *
     * @var string
     */
    public const PATTERN = '';

    /**
     * @param mixed $value
     *
     * @throws InvalidStringException
     */
    public static function validate($value)
    {
        parent::validate($value);

        if (!empty(static::PATTERN) && !preg_match(static::PATTERN, $value)) {
            throw new InvalidStringException('String does not match the required pattern.');
        }
    }
}
