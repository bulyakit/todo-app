<?php

namespace App\Apps\ToDo\Application\Service;

use App\Apps\ToDo\Application\Collection\ToDoCollection;
use App\Apps\ToDo\Application\Contract\ToDoServiceInterface;
use App\Apps\ToDo\Domain\Service\AddToDoService;
use App\Apps\ToDo\Domain\Service\GetAllToDoService;
use App\Apps\ToDo\Infrastructure\Persistence\Factory\ToDoFactory;
use App\Apps\ToDo\Infrastructure\Persistence\Repository\ToDoRepository;
use App\Database\Contract\ConnectionInterface;
use Scalar\Exception\InvalidCollectionItemException;
use App\Scalar\ValueObject\Boolean\BooleanValue;
use App\Scalar\ValueObject\DateTime\DateTime;
use App\Scalar\ValueObject\String\StringLiteral;

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
