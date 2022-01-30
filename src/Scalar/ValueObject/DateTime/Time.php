<?php

namespace App\Scalar\ValueObject\DateTime;

use DateTime;
use Exception;
use InvalidArgumentException;
use JsonSerializable;
use App\Scalar\Contract\ValueObjectInterface;
use Scalar\Exception\IntegerOutOfRangeException;
use Scalar\Exception\NumericValueOutOfRangeException;

/**
 * Class Time
 *
 * @package ToDoApp\Scalar
 */
class Time implements JsonSerializable, ValueObjectInterface
{
    /**
     * @var Hour
     */
    private $hour;

    /**
     * @var Minute
     */
    private $minute;

    /**
     * @var Second
     */
    private $second;

    /**
     * @var MicroSecond
     */
    private $microSecond;

    /**
     * Time constructor.
     *
     * @param Hour $hour
     * @param Minute $minute
     * @param Second $second
     * @param MicroSecond|null $microSecond
     *
     * @throws IntegerOutOfRangeException
     * @throws NumericValueOutOfRangeException
     */
    public function __construct(Hour $hour, Minute $minute, Second $second, MicroSecond $microSecond = null)
    {
        $this->hour   = $hour;
        $this->minute = $minute;
        $this->second = $second;

        if (is_null($microSecond)) {
            $this->microSecond = new MicroSecond(0);
        } else {
            $this->microSecond = $microSecond;
        }
    }

    /**
     * @param int $hour
     * @param int $minute
     * @param int $second
     * @param null|int $microSecond
     *
     * @return Time
     *
     * @throws IntegerOutOfRangeException
     * @throws NumericValueOutOfRangeException
     */
    public static function buildFromNative(int $hour, int $minute, int $second, int $microSecond = null): Time
    {
        return new static(
            new Hour($hour),
            new Minute($minute),
            new Second($second),
            ($microSecond ? new MicroSecond($microSecond) : null)
        );
    }

    /**
     * @param \App\Scalar\ValueObject\DateTime\DateTime $dateTime
     *
     * @return Time
     *
     * @throws IntegerOutOfRangeException
     * @throws NumericValueOutOfRangeException
     */
    public static function buildFromDateTime(DateTime $dateTime): Time
    {
        return new static(
            Hour::buildFromDateTime($dateTime),
            Minute::buildFromDateTime($dateTime),
            Second::buildFromDateTime($dateTime),
            MicroSecond::buildFromDateTime($dateTime)
        );
    }

    /**
     * @return Time
     *
     * @throws Exception
     * @throws IntegerOutOfRangeException
     * @throws NumericValueOutOfRangeException
     *
     * @codeCoverageIgnore
     */
    public static function buildFromDefault(): Time
    {
        $microTime = sprintf('%.6F', microtime(true));
        $dateTime  = DateTime::createFromFormat('U.u', $microTime);
        $dateTime->setTimezone((new DateTime())->getTimezone());

        return static::buildFromDateTime($dateTime);
    }

    /**
     * @return Hour
     */
    public function getHour(): Hour
    {
        return $this->hour;
    }

    /**
     * @return Minute
     */
    public function getMinute(): Minute
    {
        return $this->minute;
    }

    /**
     * @return Second
     */
    public function getSecond(): Second
    {
        return $this->second;
    }

    /**
     * @return MicroSecond
     */
    public function getMicroSecond(): MicroSecond
    {
        return $this->microSecond;
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
     *
     * @throws InvalidArgumentException
     */
    public function isEqualTo(ValueObjectInterface $value): bool
    {
        if (!($value instanceof Time)) {
            throw new InvalidArgumentException('Invalid Time object');
        }

        return $this->hour->isEqualTo($value->getHour()) &&
            $this->minute->isEqualTo($value->getMinute()) &&
            $this->second->isEqualTo($value->getSecond()) &&
            $this->microSecond->isEqualTo($value->getMicroSecond());
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        if ($this->microSecond->getValue()) {
            $time = sprintf(
                '%02d:%02d:%02d.%06d',
                $this->hour->getValue(),
                $this->minute->getValue(),
                $this->second->getValue(),
                $this->microSecond->getValue()
            );
        } else {
            $time = sprintf(
                '%02d:%02d:%02d',
                $this->hour->getValue(),
                $this->minute->getValue(),
                $this->second->getValue()
            );
        }

        return $time;
    }
}
