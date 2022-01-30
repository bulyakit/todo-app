<?php

namespace App\Scalar\ValueObject\DateTime;

use DateTime;
use Exception;
use Scalar\Exception\IntegerOutOfRangeException;
use Scalar\Exception\NumericValueOutOfRangeException;
use App\Scalar\ValueObject\Numeric\UnsignedInteger;

/**
 * Class Year
 *
 * @package ToDoApp\Scalar
 */
class Year extends UnsignedInteger
{
    /**
     * @param \App\Scalar\ValueObject\DateTime\DateTime $dateTime
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
