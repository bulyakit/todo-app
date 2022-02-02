<?php

namespace App\Apps\ToDo\Application\Service;

use App\Apps\ToDo\Application\Collection\ToDoCollection;
use App\Apps\ToDo\Application\Contract\ToDoServiceInterface;
use App\Apps\ToDo\Domain\Contract\ToDoRepositoryInterface;
use App\Apps\ToDo\Domain\Service\AddToDoService;
use App\Apps\ToDo\Domain\Service\GetAllToDoService;
use App\Apps\ToDo\Domain\Service\SetDoneToDoService;
use App\Apps\ToDo\Infrastructure\Persistence\Factory\ToDoFactory;
use App\Apps\ToDo\Infrastructure\Persistence\Repository\ToDoRepository;
use App\Database\Contract\ConnectionInterface;
use DateTime;

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
     * @param string $taskName
     * @param DateTime $dateTime
     *
     * @return int
     */
    public function add(string $taskName, DateTime $dateTime): int
    {
        $repository     = $this->getTodoRepositoryInterface();
        $addToDoService = new AddToDoService($repository);

        return $addToDoService->add($taskName, $dateTime);
    }

    /**
     * @return ToDoCollection
     */
    public function getAll(): ToDoCollection
    {
        $repository        = $this->getTodoRepositoryInterface();
        $getAllToDoService = new GetAllToDoService($repository);

        return $getAllToDoService->getAll();
    }

    /**
     * @param int $toDoId
     *
     * @return void
     */
    public function setDone(int $toDoId)
    {
        $repository         = $this->getTodoRepositoryInterface();
        $setDoneToDoService = new SetDoneToDoService($repository);

        $setDoneToDoService->set($toDoId);
    }

    /**
     * @return ToDoRepositoryInterface
     */
    private function getTodoRepositoryInterface(): ToDoRepositoryInterface
    {
        $factory = new ToDoFactory();

        return new TodoRepository($this->connection, $factory);
    }
}
