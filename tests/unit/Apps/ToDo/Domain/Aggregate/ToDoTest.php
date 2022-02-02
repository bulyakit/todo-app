<?php

namespace App\Tests\Unit\Apps\ToDo\Domain\Aggregate;

use App\Apps\ToDo\Domain\Aggregate\ToDo;
use DateTime;
use PHPUnit\Framework\TestCase;

class ToDoTest extends TestCase
{
    /**
     * @dataProvider providerForTestGetters
     */
    public function testGetters(
        int $id,
        string $taskName,
        DateTime $dateTime,
        bool $isDone,
        DateTime $createdAt
    ) {
        $toDo = new ToDo(
            $id,
            $taskName,
            $dateTime,
            $isDone,
            $createdAt
        );

        $this->assertEquals($id, $toDo->getId());
        $this->assertEquals($taskName, $toDo->getTaskName());
        $this->assertEquals($dateTime, $toDo->getDateTime());
        $this->assertEquals($isDone, $toDo->getIsDone());
        $this->assertEquals($createdAt, $toDo->getCreatedAt());
    }

    /**
     * @return array
     */
    public function providerForTestGetters(): array
    {
        return [
            [
                1,
                'test taskName',
                DateTime::createFromFormat('Y-m-d H:i:s', '2022-02-02 11:22:11'),
                false,
                DateTime::createFromFormat('Y-m-d H:i:s', '2022-02-01 22:11:00')
            ],
        ];
    }
}
