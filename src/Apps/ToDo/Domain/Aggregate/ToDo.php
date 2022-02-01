<?php

namespace App\Apps\ToDo\Domain\Aggregate;

use DateTime;

/**
 * Class ToDo
 */
class ToDo
{
    /**
     * @var string
     */
    private string $taskName;

    /**
     * @var DateTime
     */
    private DateTime $dateTime;

    /**
     * @var bool
     */
    private bool $isDone;

    /**
     * @var DateTime
     */
    private DateTime $createdAt;

    /**
     * @param string $taskName
     * @param DateTime $dateTime
     * @param bool $isDone
     * @param DateTime $createdAt
     */
    public function __construct(
        string $taskName,
        DateTime $dateTime,
        bool $isDone,
        DateTime $createdAt
    ) {
        $this->taskName  = $taskName;
        $this->dateTime  = $dateTime;
        $this->isDone    = $isDone;
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getTaskName(): string
    {
        return $this->taskName;
    }

    /**
     * @return DateTime
     */
    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }

    /**
     * @return bool
     */
    public function getIsDone(): bool
    {
        return $this->isDone;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }


}
