<?php

namespace ToDoApp\Scalar\ValueObject\DateTime;

use DateTime;
use Exception;
use ToDoApp\Scalar\Exception\IntegerOutOfRangeException;
use ToDoApp\Scalar\Exception\NumericValueOutOfRangeException;
use ToDoApp\Scalar\ValueObject\Numeric\UnsignedInteger;

/**
 * Class Month
 *
 * @package ToDoApp\Scalar
 */
class Month extends UnsignedInteger
{
    /**
     * Lower limit.
     *
     * @var int
     */
    public const LIMIT_LOWER = 1;

    /**
     * Upper limit.
     *
     * @var int
     */
    public const LIMIT_UPPER = 12;

    /**
     * @param DateTime $dateTime
     *
     * @return Month
     *
     * @throws IntegerOutOfRangeException
     * @throws NumericValueOutOfRangeException
     */
    public static function buildFromDateTime(DateTime $dateTime): Month
    {
        return new static(
            intval($dateTime->format('n'))
        );
    }

    /**
     * @return Month
     *
     * @throws Exception
     * @throws IntegerOutOfRangeException
     * @throws NumericValueOutOfRangeException
     *
     * @codeCoverageIgnore
     */
    public static function buildFromDefault(): Month
    {
        $dateTime = new DateTime('now');

        return static::buildFromDateTime($dateTime);
    }
}
