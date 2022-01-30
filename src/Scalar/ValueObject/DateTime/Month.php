<?php

namespace App\Scalar\ValueObject\DateTime;

use DateTime;
use Exception;
use Scalar\Exception\IntegerOutOfRangeException;
use Scalar\Exception\NumericValueOutOfRangeException;
use App\Scalar\ValueObject\Numeric\UnsignedInteger;

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
     * @param \App\Scalar\ValueObject\DateTime\DateTime $dateTime
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
