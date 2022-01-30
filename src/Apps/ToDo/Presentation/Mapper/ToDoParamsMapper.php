<?php

namespace App\Apps\ToDo\Presentation\Mapper;

use Scalar\Exception\IntegerOutOfRangeException;
use Scalar\Exception\InvalidDateException;
use Scalar\Exception\InvalidStringException;
use Scalar\Exception\InvalidTimeZoneException;
use Scalar\Exception\NumericValueOutOfRangeException;
use App\Scalar\ValueObject\DateTime\DateTime;
use App\Scalar\ValueObject\String\StringLiteral;

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
//            new UnsignedInteger($params['id']),
            new StringLiteral($params['taskName']),
            DateTime::buildFromString($params['dateTime']),
//            new BooleanValue($params['isDone']),
        ];
    }
}
