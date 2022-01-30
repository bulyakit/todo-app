<?php

namespace App\Scalar\ValueObject\DateTime;

use DateTime;
use Exception;
use JsonSerializable;
use App\Scalar\Contract\ValueObjectInterface;
use Scalar\Exception\IntegerOutOfRangeException;
use Scalar\Exception\InvalidDateException;
use Scalar\Exception\NumericValueOutOfRangeException;

/**
 * Class Date
 *
 * @package ToDoApp\Scalar
 */
class Date implements JsonSerializable, ValueObjectInterface
{
    /**
     * @var Year
     */
    private $year;

    /**
     * @var Month
     */
    private $month;

    /**
     * @var Day
     */
    private $day;

    /**
     * Date constructor.
     *
     * @param Year $year
     * @param Month $month
     * @param Day $day
     *
     * @throws InvalidDateException
     */
    public function __construct(Year $year, Month $month, Day $day)
    {
        static::validate($year, $month, $day);

        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
    }

    /**
     * @param Year $year
     * @param Month $month
     * @param Day $day
     *
     * @throws InvalidDateException
     */
    public static function validate(Year $year, Month $month, Day $day)
    {
        if (!checkdate($month->getValue(), $day->getValue(), $year->getValue())) {
            $classParts = explode('\\', static::class);
            $className  = end($classParts);
            throw new InvalidDateException('Invalid ' . $className);
        }
    }

    /**
     * @param int $year
     * @param int $month
     * @param int $day
     *
     * @return Date
     *
     * @throws IntegerOutOfRangeException
     * @throws InvalidDateException
     * @throws NumericValueOutOfRangeException
     */
    public static function buildFromNative(int $year, int $month, int $day): Date
    {
        return new static(
            new Year($year),
            new Month($month),
            new Day($day)
        );
    }

    /**
     * @param \App\Scalar\ValueObject\DateTime\DateTime $dateTime
     *
     * @return Date
     *
     * @throws IntegerOutOfRangeException
     * @throws InvalidDateException
     * @throws NumericValueOutOfRangeException
     */
    public static function buildFromDateTime(DateTime $dateTime): Date
    {
        return new static(
            Year::buildFromDateTime($dateTime),
            Month::buildFromDateTime($dateTime),
            Day::buildFromDateTime($dateTime)
        );
    }

    /**
     * @param string $date
     *
     * @return Date
     *
     * @throws Exception
     * @throws IntegerOutOfRangeException
     * @throws InvalidDateException
     */
    public static function buildFromString(string $date): Date
    {
        return static::buildFromDateTime(new DateTime($date));
    }

    /**
     * @return Date
     *
     * @throws Exception
     * @throws IntegerOutOfRangeException
     * @throws InvalidDateException
     *
     * @codeCoverageIgnore
     */
    public static function buildFromDefault(): Date
    {
        $dateTime = new DateTime('now');

        return static::buildFromDateTime($dateTime);
    }

    /**
     * @return Year
     */
    public function getYear(): Year
    {
        return $this->year;
    }

    /**
     * @return Month
     */
    public function getMonth(): Month
    {
        return $this->month;
    }

    /**
     * @return Day
     */
    public function getDay(): Day
    {
        return $this->day;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->__toString();
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
        return $value instanceof Date &&
               $this->year->isEqualTo($value->getYear()) &&
               $this->month->isEqualTo($value->getMonth()) &&
               $this->day->isEqualTo($value->getDay());
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            '%d-%02d-%02d',
            $this->year->getValue(),
            $this->month->getValue(),
            $this->day->getValue()
        );
    }
}
