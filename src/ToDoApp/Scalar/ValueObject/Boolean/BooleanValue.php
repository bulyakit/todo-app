<?php

namespace ToDoApp\Scalar\ValueObject\Boolean;

use ToDoApp\Scalar\Exception\InvalidBooleanValueException;
use ToDoApp\Scalar\ValueObject\ValueObjectAbstract;

/**
 * Class Boolean
 *
 * @package ToDoApp\Scalar
 */
class BooleanValue extends ValueObjectAbstract
{
    /**
     * Boolean constructor.
     *
     * @param bool $value
     */
    public function __construct(bool $value)
    {
        parent::__construct($value);
    }

    /**
     * @param mixed $value
     *
     * @throws InvalidBooleanValueException
     */
    public static function validate($value)
    {
        if (!is_bool($value)) {
            throw new InvalidBooleanValueException('Invalid ' . static::getClassName());
        }
    }
}
