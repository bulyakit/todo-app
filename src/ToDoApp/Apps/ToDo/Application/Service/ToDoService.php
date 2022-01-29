<?php

namespace ToDoApp\Apps\ToDo\Application\Service;

use ToDoApp\Apps\ToDo\Application\Collection\ToDoCollection;
use ToDoApp\Apps\ToDo\Domain\Service\AddToDoService;
use ToDoApp\Apps\ToDo\Domain\Service\GetAllToDoService;
use ToDoApp\Apps\ToDo\Application\Contract\ToDoServiceInterface;
use ToDoApp\Apps\Todo\Infrastructure\Persistence\Factory\ToDoFactory;
use ToDoApp\Apps\ToDo\Infrastructure\Persistence\Repository\ToDoRepository;
use ToDoApp\Database\Contract\ConnectionInterface;
use ToDoApp\Scalar\Exception\InvalidCollectionItemException;
use ToDoApp\Scalar\ValueObject\Boolean\BooleanValue;
use ToDoApp\Scalar\ValueObject\DateTime\DateTime;
use ToDoApp\Scalar\ValueObject\String\StringLiteral;

/**
 * Class ToDoService
 */
class ToDoService implements ToDoServiceInterface
{
    /**
     * @var ConnectionInterface
     */
    private ConnectionInterface $connection;

    /**
     * @param ConnectionInterface $connection
     */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param StringLiteral $taskName
     * @param DateTime $dateTime
     * @param BooleanValue $isDone
     */
    public function add(StringLiteral $taskName, DateTime $dateTime, BooleanValue $isDone)
    {
        $repository = $this->getTodoRepositoryService();
        $addToDoService = new AddToDoService($repository);

        $addToDoService->add($taskName, $dateTime, $isDone);
    }

    /**
     * @return ToDoCollection
     * @throws InvalidCollectionItemException
     */
    public function getAll(): ToDoCollection
    {
        $repository = $this->getTodoRepositoryService();
        $getAllToDoService = new GetAllToDoService($repository);

        return $getAllToDoService->getAll();
    }

    private function getTodoRepositoryService(): TodoRepository
    {
        $factory = new ToDoFactory();

        return new TodoRepository($this->connection, $factory);
    }
}
