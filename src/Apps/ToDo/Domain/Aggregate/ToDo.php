<?php

namespace App\Apps\ToDo\Domain\Aggregate;

use DateTime;

/**
 * Class ToDo
 */
class ToDo
{
    /**
     * @var int
     */
    private int $id;

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
     * @param int $id
     * @param string $taskName
     * @param DateTime $dateTime
     * @param bool $isDone
     * @param DateTime $createdAt
     */
    public function __construct(
        int $id,
        string $taskName,
        DateTime $dateTime,
        bool $isDone,
        DateTime $createdAt
    ) {
        $this->id        = $id;
        $this->taskName  = $taskName;
        $this->dateTime  = $dateTime;
        $this->isDone    = $isDone;
        $this->createdAt = $createdAt;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
