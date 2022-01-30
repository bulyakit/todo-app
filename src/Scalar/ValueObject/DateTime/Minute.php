<?php

namespace App\Scalar\ValueObject\DateTime;

use DateTime;
use Exception;
use Scalar\Exception\IntegerOutOfRangeException;
use Scalar\Exception\NumericValueOutOfRangeException;
use App\Scalar\ValueObject\Numeric\UnsignedInteger;

/**
 * Class Minute
 *
 * @package ToDoApp\Scalar
 */
class Minute extends UnsignedInteger
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
    public const LIMIT_UPPER = 59;

    /**
     * @param \App\Scalar\ValueObject\DateTime\DateTime $dateTime
     *
     * @return Minute
     *
     * @throws IntegerOutOfRangeException
     * @throws NumericValueOutOfRangeException
     */
    public static function buildFromDateTime(DateTime $dateTime): Minute
    {
        return new static(
            intval($dateTime->format('i'))
        );
    }

    /**
     * @return Minute
     *
     * @throws Exception
     * @throws IntegerOutOfRangeException
     * @throws NumericValueOutOfRangeException
     *
     * @codeCoverageIgnore
     */
    public static function buildFromDefault(): Minute
    {
        $dateTime = new DateTime('now');

        return static::buildFromDateTime($dateTime);
    }
}
