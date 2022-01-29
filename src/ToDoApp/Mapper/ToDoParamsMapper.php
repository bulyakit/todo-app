<?php

namespace ToDoApp\Mapper;

use ToDoApp\Scalar\Exception\IntegerOutOfRangeException;
use ToDoApp\Scalar\Exception\InvalidDateException;
use ToDoApp\Scalar\Exception\InvalidStringException;
use ToDoApp\Scalar\Exception\InvalidTimeZoneException;
use ToDoApp\Scalar\Exception\NumericValueOutOfRangeException;
use ToDoApp\Scalar\ValueObject\Boolean\BooleanValue;
use ToDoApp\Scalar\ValueObject\DateTime\DateTime;
use ToDoApp\Scalar\ValueObject\Numeric\UnsignedInteger;
use ToDoApp\Scalar\ValueObject\String\StringLiteral;

/**
 * Class ToDoParamsMapper
 */
class ToDoParamsMapper
{
    /**
     * @param array $params
     *
     * @return array
     *
     * @throws IntegerOutOfRangeException
     * @throws NumericValueOutOfRangeException
     * @throws InvalidStringException
     * @throws InvalidTimeZoneException
     * @throws InvalidDateException
     */
    public function mapAdd(array $params): array
    {
        return [
            new UnsignedInteger($params['id']),
            new StringLiteral($params['taskName']),
            DateTime::buildFromString($params['dateTime']),
            new BooleanValue($params['isDone']),
        ];
    }
}
