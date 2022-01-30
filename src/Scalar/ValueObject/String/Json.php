<?php

namespace App\Scalar\ValueObject\String;

use Scalar\Exception\InvalidJsonException;
use Scalar\Exception\InvalidStringException;

/**
 * Class Json
 *
 * @package ToDoApp\Scalar
 */
class Json extends StringLiteral
{
    /**
     * @param array $value
     *
     * @return Json
     *
     * @throws InvalidStringException
     */
    public static function buildFromArray(array $value): Json
    {
        return new static(
            json_encode($value)
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return json_decode($this->value, true);
    }

    /**
     * @param mixed $value
     *
     * @throws InvalidStringException
     * @throws InvalidJsonException
     */
    public static function validate($value)
    {
        parent::validate($value);

        json_decode($value);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidJsonException('Invalid JSON [value: ' . $value . ']');
        }
    }
}
