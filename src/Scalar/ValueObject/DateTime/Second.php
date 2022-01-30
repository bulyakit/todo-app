<?php

namespace App\Scalar\ValueObject\DateTime;

use DateTime;
use Exception;
use Scalar\Exception\IntegerOutOfRangeException;
use Scalar\Exception\NumericValueOutOfRangeException;
use App\Scalar\ValueObject\Numeric\UnsignedInteger;

/**
 * Class Second
 *
 * @package ToDoApp\Scalar
 */
class Second extends UnsignedInteger
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
     * @return Second
     *
     * @throws IntegerOutOfRangeException
     * @throws NumericValueOutOfRangeException
     */
    public static function buildFromDateTime(DateTime $dateTime): Second
    {
        return new static(
            intval($dateTime->format('s'))
        );
    }

    /**
     * @return Second
     *
     * @throws Exception
     * @throws IntegerOutOfRangeException
     * @throws NumericValueOutOfRangeException
     *
     * @codeCoverageIgnore
     */
    public static function buildFromDefault(): Second
    {
        $dateTime = new DateTime('now');

        return static::buildFromDateTime($dateTime);
    }
}
