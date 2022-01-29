<?php

namespace ToDoApp\Scalar\ValueObject\Numeric;

/**
 * Class SignedFloat
 */
class UnsignedFloat extends SignedFloat
{
    /**
     * Lower limit.
     *
     * @var float
     */
    public const LIMIT_LOWER = 0;

    /**
     * Upper limit.
     *
     * @var float
     */
    public const LIMIT_UPPER = INF;
}
