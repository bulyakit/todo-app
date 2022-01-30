<?php

namespace ToDoApp\Apps\ToDo\Presentation\Exception;

use Exception;
use Throwable;

/**
 * Class InvalidRequestException
 */
class InvalidRequestException extends Exception
{
    /**
     * @var array
     */
    private array $errors = [];

    /**
     * InvalidRequestException constructor.
     *
     * @param array $errors
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(array $errors, int $code = 0, Throwable $previous = null)
    {
        parent::__construct('Invalid request', $code, $previous);

        $this->errors = $errors;
    }

    /**
     * [
     *   'field1' => 'error message',
     *   'field2' => 'error message',
     *   [...],
     * ]
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
