<?php

namespace ToDoApp\Scalar\ValueObject\DateTime;

use DateTimeZone;
use Exception;
use ToDoApp\Scalar\Exception\InvalidStringException;
use ToDoApp\Scalar\Exception\InvalidTimeZoneException;
use ToDoApp\Scalar\ValueObject\String\StringLiteral;

/**
 * Class TimeZone
 *
 * @package ToDoApp\Scalar
 */
class TimeZone extends StringLiteral
{
    /**
     * TimeZone constructor.
     *
     * @param null|string $value
     *
     * @throws Exception
     * @throws InvalidTimeZoneException
     * @throws InvalidStringException
     */
    public function __construct(string $value = null)
    {
        if (is_null($value)) {
            $value = (new \DateTime())->getTimezone()->getName();
        }

        static::validate($value);
        parent::__construct($value);
    }

    /**
     * @param DateTimeZone $timeZone
     *
     * @return TimeZone
     *
     * @throws InvalidTimeZoneException
     * @throws InvalidStringException
     */
    public static function buildFromDateTimeZone(DateTimeZone $timeZone): TimeZone
    {
        return new static($timeZone->getName());
    }

    /**
     * @return TimeZone
     *
     * @throws InvalidTimeZoneException
     * @throws InvalidStringException
     */
    public static function buildFromDefault(): TimeZone
    {
        return new static(null);
    }

    /**
     * @return DateTimeZone
     */
    public function getDateTimeZone(): DateTimeZone
    {
        return new DateTimeZone($this->getValue());
    }

    /**
     * @param mixed $value
     *
     * @throws InvalidTimeZoneException
     */
    public static function validate($value)
    {
        $isValidTimeZone = in_array($value, DateTimeZone::listIdentifiers(), true);
        $isValidOffset   = preg_match('/^[+-]\d{2}:?\d{2}$/', $value);

        if (!$isValidTimeZone && !$isValidOffset) {
            throw new InvalidTimeZoneException('Invalid time zone [value: ' . $value . ']');
        }
    }
}
