<?php

namespace App\Scalar\ValueObject\DateTime;

use DateTime;
use Scalar\Exception\IntegerOutOfRangeException;
use Scalar\Exception\NumericValueOutOfRangeException;
use App\Scalar\ValueObject\Numeric\UnsignedInteger;

/**
 * Class MicroSecond
 *
 * @package ToDoApp\Scalar
 */
class MicroSecond extends UnsignedInteger
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
    public const LIMIT_UPPER = 999999;

    /**
     * @param \App\Scalar\ValueObject\DateTime\DateTime $dateTime
     *
     * @return MicroSecond
     *
     * @throws IntegerOutOfRangeException
     * @throws NumericValueOutOfRangeException
     */
    public static function buildFromDateTime(DateTime $dateTime): MicroSecond
    {
        return new static(
            intval($dateTime->format('u'))
        );
    }

    /**
     * @return MicroSecond
     *
     * @throws IntegerOutOfRangeException
     * @throws NumericValueOutOfRangeException
     *
     * @codeCoverageIgnore
     */
    public static function buildFromDefault(): MicroSecond
    {
        $microTime   = microtime(true);
        $second      = floor($microTime);
        $microSecond = ($microTime - $second) * 1000000;

        return new static(round($microSecond));
    }
}
