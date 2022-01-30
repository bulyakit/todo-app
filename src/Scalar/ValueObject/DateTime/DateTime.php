<?php

namespace App\Scalar\ValueObject\DateTime;

use Exception;
use JsonSerializable;
use App\Scalar\Contract\ValueObjectInterface;
use Scalar\Exception\IntegerOutOfRangeException;
use Scalar\Exception\InvalidDateException;
use Scalar\Exception\InvalidStringException;
use Scalar\Exception\InvalidTimeZoneException;
use Scalar\Exception\NumericValueOutOfRangeException;

/**
 * Class DateTime
 *
 * @package ToDoApp\Scalar
 */
class DateTime implements JsonSerializable, ValueObjectInterface
{
    /**
     * @var Date
     */
    private $date;

    /**
     * @var Time
     */
    private $time;

    /**
     * @var TimeZone
     */
    private $timeZone;

    /**
     * DateTime constructor.
     *
     * @param Date $date
     * @param Time $time
     * @param TimeZone|null $timeZone
     *
     * @throws InvalidStringException
     * @throws InvalidTimeZoneException
     */
    public function __construct(Date $date, Time $time, TimeZone $timeZone = null)
    {
        $this->date = $date;
        $this->time = $time;

        if (is_null($timeZone)) {
            $this->timeZone = TimeZone::buildFromDefault();
        } else {
            $this->timeZone = $timeZone;
        }
    }

    /**
     * @param \DateTime $dateTime
     *
     * @return DateTime
     *
     * @throws IntegerOutOfRangeException
     * @throws InvalidDateException
     * @throws InvalidStringException
     * @throws InvalidTimeZoneException
     * @throws NumericValueOutOfRangeException
     */
    public static function buildFromDateTime(\DateTime $dateTime): DateTime
    {
        return new static(
            Date::buildFromDateTime($dateTime),
            Time::buildFromDateTime($dateTime),
            TimeZone::buildFromDateTimeZone($dateTime->getTimezone())
        );
    }

    /**
     * @param string $dateTime
     *
     * @return DateTime
     *
     * @throws Exception
     * @throws IntegerOutOfRangeException
     * @throws InvalidDateException
     * @throws InvalidStringException
     * @throws InvalidTimeZoneException
     */
    public static function buildFromString(string $dateTime): DateTime
    {
        return static::buildFromDateTime(new \DateTime($dateTime));
    }

    /**
     * @return DateTime
     *
     * @throws Exception
     * @throws IntegerOutOfRangeException
     * @throws InvalidDateException
     * @throws InvalidStringException
     * @throws InvalidTimeZoneException
     *
     * @codeCoverageIgnore
     */
    public static function buildFromDefault(): DateTime
    {
        $dateTime = new \DateTime('now');

        return static::buildFromDateTime($dateTime);
    }

    /**
     * @return Date
     */
    public function getDate(): Date
    {
        return $this->date;
    }

    /**
     * @return Time
     */
    public function getTime(): Time
    {
        return $this->time;
    }

    /**
     * @return TimeZone
     */
    public function getTimeZone(): TimeZone
    {
        return $this->timeZone;
    }

    /**
     * @return \DateTime
     *
     * @throws Exception
     */
    public function getDateTime(): \DateTime
    {
        return new \DateTime($this->getValue(), $this->timeZone->getDateTimeZone());
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->__toString();
    }

    /**
     * ISO 8601 date (2004-02-12T15:19:21+00:00).
     *
     * @return string
     *
     * @throws Exception
     */
    public function getIsoDate(): string
    {
        return $this->getDateTime()->format('c');
    }

    /**
     * @return string
     */
    public function jsonSerialize(): string
    {
        return $this->getValue();
    }

    /**
     * @param ValueObjectInterface $value
     *
     * @return bool
     */
    public function isEqualTo(ValueObjectInterface $value): bool
    {
        return $value instanceof DateTime &&
               $this->date->isEqualTo($value->getDate()) &&
               $this->time->isEqualTo($value->getTime()) &&
               $this->timeZone->isEqualTo($value->getTimeZone());
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf('%s %s', $this->date->__toString(), $this->time->__toString());
    }
}
