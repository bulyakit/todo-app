<?php

namespace ToDoApp\Scalar\ValueObject\DateTime;

use DateTime;
use Exception;
use ToDoApp\Scalar\Exception\IntegerOutOfRangeException;
use ToDoApp\Scalar\Exception\NumericValueOutOfRangeException;
use ToDoApp\Scalar\ValueObject\Numeric\UnsignedInteger;

/**
 * Class Hour
 *
 * @package ToDoApp\Scalar
 */
class Hour extends UnsignedInteger
{
    /**
     * Lower limit.
     *
     * @var int
     */
    public const LIMIT_LOWER = 0;

    /**
     * Upper limit.
     *
     * @var int
     */
    public const LIMIT_UPPER = 23;

    /**
     * @param DateTime $dateTime
     *
     * @return Hour
     *
     * @throws IntegerOutOfRangeException
     * @throws NumericValueOutOfRangeException
     */
    public static function buildFromDateTime(DateTime $dateTime): Hour
    {
        return new static(
            intval($dateTime->format('G'))
        );
    }

    /**
     * @return Hour
     *
     * @throws Exception
     * @throws IntegerOutOfRangeException
     * @throws NumericValueOutOfRangeException
     *
     * @codeCoverageIgnore
     */
    public static function buildFromDefault(): Hour
    {
        $dateTime = new DateTime('now');

        return static::buildFromDateTime($dateTime);
    }
}
