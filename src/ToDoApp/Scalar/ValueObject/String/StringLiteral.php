<?php

namespace ToDoApp\Scalar\ValueObject\String;

use ToDoApp\Scalar\Exception\InvalidStringException;
use ToDoApp\Scalar\ValueObject\ValueObjectAbstract;

/**
 * Class StringLiteral
 */
class StringLiteral extends ValueObjectAbstract
{
    /**
     * StringLiteral constructor.
     *
     * @param string $value
     *
     * @throws InvalidStringException
     */
    public function __construct(string $value)
    {
        static::validate($value);
        parent::__construct($value);
    }

    /**
     * @param mixed $value
     *
     * @throws InvalidStringException
     */
    public static function validate($value)
    {
        if (!is_string($value)) {
            throw new InvalidStringException('Invalid ' . static::getClassName());
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }
}
