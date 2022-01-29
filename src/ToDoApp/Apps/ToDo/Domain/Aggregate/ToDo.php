<?php

namespace ToDoApp\Apps\ToDo\Domain\Aggregate;

/**
 * Class ToDo
 */
class ToDo
{
    /**
     * @var string
     */
    private string $service;

    /**
     * @param string $service
     */
    public function __construct(
        string $service
    ) {
        $this->service = $service;
    }

    public function getService(): string
    {
        return $this->service;
    }
}
