<?php

namespace Livita\Scalar\ValueObject\Numeric;

/**
 * Class Percent
 *
 * @package Livita\Scalar
 */
class Percent extends UnsignedInteger
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
    public const LIMIT_UPPER = 100;
}
