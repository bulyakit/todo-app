<?php

namespace App\Scalar\ValueObject;

use JsonSerializable;
use App\Scalar\Contract\ValueObjectInterface;

/**
 * Class ValueObjectAbstract
 */
abstract class ValueObjectAbstract implements ValueObjectInterface, JsonSerializable
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize()
    {
        return $this->value;
    }

    /**
     * @param ValueObjectInterface $valueObject
     *
     * @return bool
     */
    public function isEqualTo(ValueObjectInterface $valueObject): bool
    {
        return $this->getValue() === $valueObject->getValue();
    }

    /**
     * @return string
     */
    protected static function getClassName(): string
    {
        $classParts = explode('\\', static::class);

        return end($classParts);
    }
}
