<?php

namespace ToDoApp\Scalar\ValueObject\DateTime;

use DateTime;
use Exception;
use ToDoApp\Scalar\Exception\IntegerOutOfRangeException;
use ToDoApp\Scalar\Exception\NumericValueOutOfRangeException;
use ToDoApp\Scalar\ValueObject\Numeric\UnsignedInteger;

/**
 * Class Day
 *
 * @package ToDoApp\Scalar
 */
class Day extends UnsignedInteger
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
    public const LIMIT_UPPER = 31;

    /**
     * @param DateTime $dateTime
     *
     * @return Day
     *
     * @throws IntegerOutOfRangeException
     * @throws NumericValueOutOfRangeException
     */
    public static function buildFromDateTime(DateTime $dateTime): Day
    {
        return new static(
            intval($dateTime->format('j'))
        );
    }

    /**
     * @return Day
     *
     * @throws Exception
     * @throws IntegerOutOfRangeException
     * @throws NumericValueOutOfRangeException
     *
     * @codeCoverageIgnore
     */
    public static function buildFromDefault(): Day
    {
        $dateTime = new DateTime('now');

        return static::buildFromDateTime($dateTime);
    }
}
