<?php

namespace App\Scalar\ValueObject\String;

use Scalar\Exception\InvalidLengthException;
use Scalar\Exception\InvalidStringException;

/**
 * Class StringLiteralLimit
 *
 * @package ToDoApp\Scalar
 */
class StringLiteralLimit extends StringLiteral
{
    /**
     * Minimum length of the string.
     *
     * @var int|null
     */
    public const MIN_LENGTH = null;

    /**
     * Maximum length of the string.
     *
     * @var int|null
     */
    public const MAX_LENGTH = null;

    /**
     * @param mixed $value
     *
     * @throws InvalidStringException
     * @throws InvalidLengthException
     */
    public static function validate($value)
    {
        parent::validate($value);

        $length = strlen($value);
        if (!is_null(static::MIN_LENGTH) && $length < static::MIN_LENGTH) {
            throw new InvalidLengthException(
                'The string is too short [value: ' . $value . ', minLength: ' . static::MIN_LENGTH . ', '
                . 'maxLength: ' . static::MAX_LENGTH . ']'
            );
        }
        if (!is_null(static::MAX_LENGTH) && $length > static::MAX_LENGTH) {
            throw new InvalidLengthException(
                'The string is too long [value: ' . $value . ', minLength: ' . static::MIN_LENGTH . ', '
                . 'maxLength: ' . static::MAX_LENGTH . ']'
            );
        }
    }
}
