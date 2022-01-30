<?php

namespace App\Scalar\ValueObject\DateTime;

use InvalidArgumentException;
use JsonSerializable;
use App\Scalar\Contract\ValueObjectInterface;
use Scalar\Exception\IntegerOutOfRangeException;
use Scalar\Exception\NumericValueOutOfRangeException;

/**
 * Class TimePeriod
 *
 * @package ToDoApp\Scalar
 */
class TimePeriod implements JsonSerializable, ValueObjectInterface
{
    /**
     * @var Hour
     */
    private $from;

    /**
     * @var Hour
     */
    private $to;

    /**
     * TimePeriod constructor.
     *
     * @param Hour $from
     * @param Hour $to
     */
    public function __construct(Hour $from, Hour $to)
    {
        $this->from = $from;
        $this->to   = $to;
    }

    /**
     * @param int $from
     * @param int $to
     *
     * @return TimePeriod
     *
     * @throws IntegerOutOfRangeException
     * @throws NumericValueOutOfRangeException
     */
    public static function buildFromNative(int $from, int $to): TimePeriod
    {
        return new static(
            new Hour($from),
            new Hour($to)
        );
    }

    /**
     * @return Hour
     */
    public function getFrom(): Hour
    {
        return $this->from;
    }

    /**
     * @return Hour
     */
    public function getTo(): Hour
    {
        return $this->to;
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
     * @return string
     */
    public function __toString(): string
    {
        return sprintf('[%02d - %02d]', $this->from->getValue(), $this->to->getValue());
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
        if (!($value instanceof TimePeriod)) {
            throw new InvalidArgumentException('Invalid Period object');
        }

        return $this->from->isEqualTo($value->getFrom()) &&
               $this->to->isEqualTo($value->getTo());
    }
}
