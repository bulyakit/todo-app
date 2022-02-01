<?php

namespace App\Apps\ToDo\Presentation\Validator;

use DateTime;
use Exception;
use InvalidArgumentException;

/**
 * Class BaseValidator
 */
class BaseValidator
{
    /**
     * @param string $field
     * @param array $params
     *
     * @throws InvalidArgumentException
     */
    protected function isValidInteger(string $field, array $params)
    {
        $this->hasField($field, $params);
        $this->isNumeric($field, $params);
    }

    /**
     * @param string $field
     * @param array $params
     *
     * @throws InvalidArgumentException
     */
    protected function isValidDateTime(string $field, array $params)
    {
        $this->hasField($field, $params);
        $this->isString($field, $params);

        try {
            new DateTime($params[$field]);
        } catch (Exception $e) {
            throw new InvalidArgumentException('Invalid ' . $field);
        }
    }

    /**
     * @param string $field
     * @param array $params
     *
     * @throws InvalidArgumentException
     */
    protected function isValidString(string $field, array $params)
    {
        $this->hasField($field, $params);
        $this->isString($field, $params);
    }

    /**
     * @param string $field
     * @param array $params
     *
     * @throws InvalidArgumentException
     */
    protected function hasField(string $field, array $params)
    {
        if (!array_key_exists($field, $params)) {
            throw new InvalidArgumentException('Missing ' . $field);
        }
    }

    /**
     * @param string $field
     * @param array $params
     *
     * @throws InvalidArgumentException
     */
    protected function isString(string $field, array $params)
    {
        if (!is_string($params[$field])) {
            throw new InvalidArgumentException('Invalid string in ' . $field);
        }
    }

    /**
     * @param string $field
     * @param array $params
     *
     * @throws InvalidArgumentException
     */
    protected function isNumeric(string $field, array $params)
    {
        if (!is_numeric($params[$field])) {
            throw new InvalidArgumentException('Invalid numeric value in ' . $field);
        }
    }
}
