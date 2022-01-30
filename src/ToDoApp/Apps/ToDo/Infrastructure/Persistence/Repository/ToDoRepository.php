<?php

namespace ToDoApp\Apps\ToDo\Infrastructure\Persistence\Repository;

use ToDoApp\Apps\ToDo\Application\Collection\ToDoCollection;
use ToDoApp\Apps\ToDo\Domain\Contract\ToDoRepositoryInterface;
use ToDoApp\Apps\Todo\Infrastructure\Persistence\Factory\ToDoFactory;
use ToDoApp\Database\Contract\ConnectionInterface;
use ToDoApp\Scalar\Exception\InvalidCollectionItemException;
use ToDoApp\Scalar\ValueObject\Boolean\BooleanValue;
use ToDoApp\Scalar\ValueObject\DateTime\DateTime;
use ToDoApp\Scalar\ValueObject\String\StringLiteral;


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
     * @param StringLiteral $taskName
     * @param DateTime $dateTime
     * @param BooleanValue $isDone
     *
     * @return void
     */
    public function add(StringLiteral $taskName, DateTime $dateTime, BooleanValue $isDone)
    {
        $query = "
            INSERT INTO
                `task`
            (
             `taskName`, 
             `dateTime`,
             `isDone`
             )
            VALUES
                (
                 :taskName,
                 :dateTime,
                 :isDone
                 )
            ";

        $bindings = [
          'taskName' => $taskName->getValue(),
          'dateTime' => $dateTime->getValue(),
          'isDone'   => $isDone->getValue(),
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
              *
            FROM
              `test_table`
        ";
//        $db    = $this->getConnection();
//        $sth   = $db->prepare($query);
//        $sth->bindParam("id", $args['id']);
//        $sth->execute();
//        $todos = $sth->fetchObject();
//        return json_encode($todos);


        $toDos          = new ToDoCollection();
        $repositoryRows = $this->connection->select($query);

        foreach ($repositoryRows as $repositoryRow) {
            $toDos->add($repositoryRow['id'], $this->factory->create($repositoryRow));
        }

        return $toDos;
    }
}
