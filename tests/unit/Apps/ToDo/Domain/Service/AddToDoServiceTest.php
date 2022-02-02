<?php

namespace App\Tests\Unit\Apps\ToDo\Domain\Service;

use App\Apps\ToDo\Domain\Contract\ToDoRepositoryInterface;
use App\Apps\ToDo\Domain\Service\AddToDoService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class AddToDoServiceTest
 */
class AddToDoServiceTest extends TestCase
{
    /**
     * @dataProvider providerForTestAdd
     */
    public function testAdd(
        string $taskName,
        \DateTime $dateTime,
        int $expected
    ) {
        /** @var ToDoRepositoryInterface|MockObject $repository */
        $repository = $this->getMockBuilder(ToDoRepositoryInterface::class)
                           ->getMock();
        $repository->expects($this->once())
                   ->method('create')
                   ->with($taskName, $dateTime)
                   ->willReturn($expected);

        $addToDoService = new AddToDoService($repository);
        $lastInsertId   = $addToDoService->add($taskName, $dateTime);

        $this->assertEquals($expected, $lastInsertId);
    }

    /**
     * @return array
     */
    public function providerForTestAdd(): array
    {
        return [
            [
                'Test task one',
                \DateTime::createFromFormat('Y-m-d H:i:s', '2022-02-02 11:22:00'),
                1,

            ],
            [
                'Test task two',
                \DateTime::createFromFormat('Y-m-d H:i:s', '2022-02-02 11:22:11'),
                2,
            ],
        ];
    }
}
