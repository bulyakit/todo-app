<?php

namespace App\Apps\ToDo\Infrastructure\Persistence\Repository;

use App\Apps\ToDo\Application\Collection\ToDoCollection;
use App\Apps\ToDo\Domain\Contract\ToDoRepositoryInterface;
use App\Apps\ToDo\Infrastructure\Persistence\Factory\ToDoFactory;
use App\Collection\Exception\InvalidCollectionItemException;
use App\Database\Contract\ConnectionInterface;


/**
 * Class ToDoRepository
 */
class ToDoRepository implements ToDoRepositoryInterface
{
    /**
     * @var ToDoFactory
     */
    private ToDoFactory $factory;

    /**
     * @var ConnectionInterface
     */
    private ConnectionInterface $connection;

    /**
     * ToDoRepository constructor.
     */
    public function __construct(ConnectionInterface $connection, ToDoFactory $factory)
    {
        $this->connection = $connection;
        $this->factory    = $factory;
    }

    /**
     * @param string $taskName
     * @param \DateTime $dateTime
     *
     * @return void
     */
    public function add(string $taskName, \DateTime $dateTime)
    {
        $query = "
            INSERT INTO
                `task`
            (
             `task_name`, 
             `datetime`,
             `created_at`
             )
            VALUES
                (
                 :taskName,
                 :dateTime,
                 :createdAt
                 )
            ";

        $bindings = [
            'taskName'  => $taskName,
            'dateTime'  => $dateTime->format('Y-m-h m:i:s'),
            'createdAt' => date_create()->format('Y-m-d H:i:s'),
        ];

        $this->connection->insert($query, $bindings);
    }

    /**
     * @return ToDoCollection
     * @throws InvalidCollectionItemException
     */
    public function getAll(): ToDoCollection
    {
        $query = "
            SELECT
              `id`,
              `task_name`,
              `datetime`,
              `is_done`,
              `created_at`
            FROM
              `task`
            ORDER BY
               `datetime`
            DESC
        ";

        $toDos          = new ToDoCollection();
        $repositoryRows = $this->connection->select($query);

        foreach ($repositoryRows as $repositoryRow) {
            $toDos->add($repositoryRow['id'], $this->factory->create($repositoryRow));
        }

        return $toDos;
    }

    /**
     * @param int $toDoId
     *
     * @return void
     */
    public function setDone(int $toDoId)
    {
        $query = "
            UPDATE
              `task`
            SET
              `is_done` = 1
            WHERE
              `id` = :id
        ";

        $bindings = [
            'id' => $toDoId,
        ];

        $this->connection->update($query, $bindings);
    }

    private function ddq($query, $bindings)
    {
        global $db;
        $result = $query;
        foreach ($bindings as $key => $val) {
            $result = str_replace(':' . $key, is_numeric($val) ? $val : "'" . $db->escape($val) . "'", $result);
        }
        die($result);
    }
}
