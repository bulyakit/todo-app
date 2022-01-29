<?php

namespace ToDoApp\Scalar\ValueObject\DateTime;

use DateTime;
use Exception;
use ToDoApp\Scalar\Exception\IntegerOutOfRangeException;
use ToDoApp\Scalar\Exception\NumericValueOutOfRangeException;
use ToDoApp\Scalar\ValueObject\Numeric\UnsignedInteger;

/**
 * Class Year
 *
 * @package ToDoApp\Scalar
 */
class Year extends UnsignedInteger
{
    /**
     * @param DateTime $dateTime
     *
     * @return Year
     *
     * @throws IntegerOutOfRangeException
     * @throws NumericValueOutOfRangeException
     */
    public static function buildFromDateTime(DateTime $dateTime): Year
    {
        return new static(
            intval($dateTime->format('Y'))
        );
    }

    /**
     * @return Year
     *
     * @throws Exception
     * @throws IntegerOutOfRangeException
     * @throws NumericValueOutOfRangeException
     *
     * @codeCoverageIgnore
     */
    public static function buildFromDefault(): Year
    {
        $dateTime = new DateTime('now');

        return static::buildFromDateTime($dateTime);
    }
}
