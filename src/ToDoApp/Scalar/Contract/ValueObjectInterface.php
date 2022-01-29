<?php

namespace ToDoApp\Scalar\Contract;

/**
 * Interface ValueObjectInterface
 */
interface ValueObjectInterface
{
    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @param ValueObjectInterface $value
     *
     * @return bool
     */
    public function isEqualTo(ValueObjectInterface $value): bool;
}
