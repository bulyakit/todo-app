<?php

namespace ToDoApp\Validator;

use DateTime;
use Exception;
use InvalidArgumentException;
use ToDoApp\Exception\InvalidRequestException;
use ToDoApp\Scalar\Exception\InvalidStringException;
use ToDoApp\Scalar\ValueObject\String\StringLiteral;

/**
 * Class BaseValidator
 */
class BaseValidator
{
    /**
     * General callback.
     *
     * @var string
     */
    public const CALLBACK = 'callback';

    /**
     * Field.
     *
     * @var string
     */
    public const FIELD = 'field';

    /**
     * Validates a request by the given requisites.
     *
     * @param array $params
     * @param array $prerequisites
     *
     * @throws InvalidRequestException
     * @throws InvalidArgumentException
     */
    protected function isValidRequest(array $params, array $prerequisites)
    {
        $errors = [];

        foreach ($prerequisites as $prerequisite) {
            if (is_array($prerequisite)) {
                $this->isValidPrerequisite($prerequisite);

                try {
                    call_user_func(
                        $prerequisite[static::CALLBACK],
                        $prerequisite[static::FIELD],
                        $params
                    );
                } catch (InvalidArgumentException $e) {
                    $errors[$prerequisite[static::FIELD]] = $e->getMessage();
                }
            }
        }

        if (count($errors)) {
            throw new InvalidRequestException($errors);
        }
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
    protected function isValidUnsignedInteger(string $field, array $params)
    {
        $this->hasField($field, $params);
        $this->isNumeric($field, $params);

        try {
            UnsignedInteger::validate($params[$field]);
        } catch (IntegerOutOfRangeException $e) {
            throw new InvalidArgumentException('Invalid ' . $field);
        }
    }

    /**
     * @param string $field
     * @param array $params
     *
     * @throws InvalidArgumentException
     */
    protected function isValidUnsignedFloat(string $field, array $params)
    {
        $this->hasField($field, $params);
        $this->isNumeric($field, $params);

        try {
            UnsignedFloat::validate($params[$field]);
        } catch (NumericValueOutOfRangeException $e) {
            throw new InvalidArgumentException('Invalid ' . $field);
        }
    }

    /**
     * @param string $field
     * @param array $params
     *
     * @throws InvalidArgumentException
     */
    protected function isValidStringLiteral(string $field, array $params)
    {
        $this->hasField($field, $params);
        $this->isString($field, $params);

        try {
            StringLiteral::validate($params[$field]);
        } catch (InvalidStringException $e) {
            throw new InvalidArgumentException('Invalid ' . $field);
        }
    }

    /**
     * @param string $field
     * @param array $params
     *
     * @throws InvalidArgumentException
     */
    protected function isValidYesNo(string $field, array $params)
    {
        $this->hasField($field, $params);

        if (!in_array($params[$field], ['y', 'n', 'yes', 'no', 1, 0], true)) {
            throw new InvalidArgumentException('Invalid ' . $field);
        }
    }

    /**
     * @param string $field
     * @param array $params
     *
     * @throws InvalidArgumentException
     */
    protected function isValidStatus(string $field, array $params)
    {
        $this->hasField($field, $params);

        if (!in_array($params[$field], [Status::ACTIVE, Status::INACTIVE], true)) {
            throw new InvalidArgumentException('Invalid ' . $field);
        }
    }

    /**
     * @param string $field
     * @param array $params
     */
    protected function isValidZipCode(string $field, array $params)
    {
        $this->hasField($field, $params);
        $this->isString($field, $params);

        try {
            ZipCode::validate($params[$field]);
        } catch (InvalidStringException $e) {
            throw new InvalidArgumentException('Invalid ' . $field);
        }
    }

    /**
     * @param string $field
     * @param array $params
     */
    protected function isValidCityName(string $field, array $params)
    {
        $this->hasField($field, $params);
        $this->isString($field, $params);

        try {
            CityName::validate($params[$field]);
        } catch (InvalidStringException $e) {
            throw new InvalidArgumentException('Invalid ' . $field);
        }
    }

    /**
     * @param string $field
     * @param array $params
     */
    protected function isValidStreet(string $field, array $params)
    {
        $this->hasField($field, $params);
        $this->isString($field, $params);

        try {
            Street::validate($params[$field]);
        } catch (InvalidStringException $e) {
            throw new InvalidArgumentException('Invalid ' . $field);
        }
    }

    /**
     * @param string $field
     * @param array $params
     *
     * @throws InvalidArgumentException
     */
    protected function isValidDataUri(string $field, array $params)
    {
        $this->hasField($field, $params);
        $this->isString($field, $params);
        $this->isValidStringLiteral($field, $params);

        if (!preg_match('/^data:/', $params[$field])) {
            throw new InvalidArgumentException('Invalid ' . $field);
        }
        // 20M
        if (strlen($params[$field]) > 20971520) {
            throw new InvalidArgumentException($field . ' is too long');
        }
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

    /**
     * @param string $field
     * @param array $params
     *
     * @throws InvalidArgumentException
     */
    protected function isValidCurrencyCode(string $field, array $params)
    {
        $this->hasField($field, $params);
        $this->isString($field, $params);

        try {
            CurrencyCode::validate($params[$field]);
        } catch (InvalidEnumValueException $e) {
            throw new InvalidArgumentException('Invalid ' . $field);
        }
    }

    /**
     * @param string $field
     * @param array $params
     *
     * @throws InvalidArgumentException
     */
    protected function isValidTimeZone(string $field, array $params)
    {
        $this->hasField($field, $params);
        $this->isString($field, $params);

        try {
            TimeZone::validate($params[$field]);
        } catch (InvalidTimeZoneException $e) {
            throw new InvalidArgumentException('Invalid ' . $field);
        }
    }

    /**
     * @param string $field
     * @param array $params
     *
     * @throws InvalidArgumentException
     */
    protected function isValidArray(string $field, array $params)
    {
        $this->hasField($field, $params);

        if (!is_array($params[$field])) {
            throw new InvalidArgumentException('Invalid ' . $field);
        }
    }

    /**
     * @param array $prerequisite
     *
     * @throws InvalidArgumentException
     */
    private function isValidPrerequisite(array $prerequisite)
    {
        if (empty($prerequisite[static::FIELD])) {
            throw new InvalidArgumentException('The field is required in prerequisite check');
        }
        if (!is_string($prerequisite[static::FIELD])) {
            throw new InvalidArgumentException('The field is invalid in prerequisite check');
        }

        if (empty($prerequisite[static::CALLBACK])) {
            throw new InvalidArgumentException(
                'The callback is required in prerequisite check [field: ' . $prerequisite[static::FIELD] . ']'
            );
        }
        if (!is_string($prerequisite[static::CALLBACK]) && !is_array($prerequisite[static::CALLBACK])) {
            throw new InvalidArgumentException(
                'The callback is invalid in prerequisite check [field: ' . $prerequisite[static::FIELD] . ']'
            );
        }
    }
}
