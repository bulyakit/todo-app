<?php

namespace ToDoApp\Scalar\ValueObject\Numeric;

use ToDoApp\Scalar\Exception\NumericValueOutOfRangeException;
use ToDoApp\Scalar\ValueObject\ValueObjectAbstract;

/**
 * Class UnsignedFloat
 */
class SignedFloat extends ValueObjectAbstract
{
    /**
     * Lower limit.
     *
     * @var float
     */
    public const LIMIT_LOWER = -INF;

    /**
     * Upper limit.
     *
     * @var float
     */
    public const LIMIT_UPPER = INF;

    /**
     * UnsignedFloat constructor.
     *
     * @param float $value
     *
     * @throws NumericValueOutOfRangeException
     */
    public function __construct(float $value)
    {
        static::validate($value);
        parent::__construct($value);
    }

    /**
     * @param mixed $value
     *
     * @throws NumericValueOutOfRangeException
     */
    public static function validate($value)
    {
        if ($value < static::LIMIT_LOWER || $value > static::LIMIT_UPPER) {
            throw new NumericValueOutOfRangeException(
                'Numeric value is out of range [value: ' . $value . ', valid range: ' . static::LIMIT_LOWER
                . ' - ' . static::LIMIT_UPPER . ']'
            );
        }
    }
}
