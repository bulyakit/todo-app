<?php

namespace App\Scalar\ValueObject\Numeric;

use Scalar\Exception\IntegerOutOfRangeException;
use Scalar\Exception\NumericValueOutOfRangeException;

/**
 * Class UnsignedInteger
 *
 * @package Livita\Scalar
 */
class UnsignedInteger extends UnsignedFloat
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
    public const LIMIT_UPPER = PHP_INT_MAX;

    /**
     * UnsignedInteger constructor.
     *
     * @param int $value
     *
     * @throws IntegerOutOfRangeException
     * @throws NumericValueOutOfRangeException
     */
    public function __construct(int $value)
    {
        static::validate($value);
        parent::__construct($value);
    }

    /**
     * @param mixed $value
     *
     * @throws IntegerOutOfRangeException
     */
    public static function validate($value)
    {
        if ($value < static::LIMIT_LOWER || $value > static::LIMIT_UPPER) {
            throw new IntegerOutOfRangeException(
                'Integer is out of range [value: ' . $value . ', valid range: ' . static::LIMIT_LOWER
                . ' - ' . static::LIMIT_UPPER . ']'
            );
        }
    }
}
