<?php

namespace ToDoApp\Database\Service;

use ToDoApp\DataBase\Contract\ConnectionInterface;
use ToDoApp\DataBase\Exception\DatabaseException;
use ToDoApp\DataBase\Exception\InvalidBindingException;

class Connection implements ConnectionInterface
{
    /**
     * @var false|\mysqli
     */
    private $connection;

    /**
     * @var array
     */
    private array $config;

    /**
     * Connection constructor.
     *
     * @param array $config
     *
     * @throws DatabaseException
     */
    public function __construct(array $config)
    {
        $this->config = $config;
        $this->initConnection();
    }

    /**
     * @param string $query
     *
     * @return array|bool
     *
     * @throws DatabaseException
     */
    public function query(string $query)
    {
        $this->ping();

        $result = $this->connection->query($query);

        if (!$result) {
            throw new DatabaseException($this->connection->error, $this->connection->errno);
        }

        if ($result instanceof \mysqli_result) {
            $result = $this->getAssociativeResult($result);
        }

        return $result;
    }

    /**
     * @param string $query
     * @param array $bindings
     * @param int $cacheTime
     *
     * @return array|null
     *
     * @throws DatabaseException
     * @throws InvalidBindingException
     */
    public function selectOne(string $query, array $bindings = [], int $cacheTime = 0): ?array
    {
        $result = $this->select($query, $bindings, $cacheTime);

        return count($result) ? reset($result) : null;
    }

    /**
     * @param string $query
     * @param array $bindings
     * @param int $cacheTime
     *
     * @return array
     *
     * @throws DatabaseException
     * @throws InvalidBindingException
     */
    public function select(string $query, array $bindings = [], int $cacheTime = 0): array
    {
        $this->ping();

        if (count($bindings)) {
            $this->bindingResolver($query, $bindings);
        }

        $statement = $this->connection->prepare($query);
        $this->bind($statement, $bindings);
        $statement->execute();

        return $this->getResult($statement);
    }

    /**
     * @param string $query
     * @param array $bindings
     *
     * @return int
     *
     * @throws DatabaseException
     * @throws InvalidBindingException
     */
    public function insert(string $query, array $bindings = []): int
    {
        $this->ping();

        if (count($bindings)) {
            $this->bindingResolver($query, $bindings);
        }

        $statement = $this->connection->prepare($query);
        $this->bind($statement, $bindings);
        $statement->execute();

        return $this->getLastInsertId($statement);
    }

    /**
     * @param string $query
     * @param array $bindings
     *
     * @return int
     *
     * @throws DatabaseException
     * @throws InvalidBindingException
     */
    public function update(string $query, array $bindings = []): int
    {
        $this->ping();

        if (count($bindings)) {
            $this->bindingResolver($query, $bindings);
        }

        $statement = $this->connection->prepare($query);
        $this->bind($statement, $bindings);
        $statement->execute();

        return $this->getAffectedRows($statement);
    }

    /**
     * @param string $query
     * @param array $bindings
     *
     * @return int
     *
     * @throws DatabaseException
     * @throws InvalidBindingException
     */
    public function delete(string $query, array $bindings = []): int
    {
        $this->ping();

        if (count($bindings)) {
            $this->bindingResolver($query, $bindings);
        }

        $statement = $this->connection->prepare($query);
        $this->bind($statement, $bindings);
        $statement->execute();

        return $this->getAffectedRows($statement);
    }

    /**
     * @param $statement
     *
     * @return int
     */
    public function getAffectedRows($statement): int
    {
        return $statement->affected_rows;
    }

    /**
     * @param $statement
     *
     * @return int
     */
    public function getLastInsertId($statement): int
    {
        return $statement->insert_id;
    }

    /**
     * @throws DatabaseException
     */
    public function ping()
    {
        if (!$this->connection || !$this->connection->thread_id || !$this->connection->ping()) {
            $this->reconnect();
        }
    }

    /**
     * @throws DatabaseException
     */
    public function reconnect()
    {
        if ($this->connection && $this->connection->thread_id) {
            $this->connection->close();
        }

        $this->initConnection();
    }

    /**
     * @return bool
     */
    public function beginTransaction(): bool
    {
        return $this->connection->begin_transaction();
    }

    /**
     * @return bool
     */
    public function rollback(): bool
    {
        return $this->connection->rollback();
    }

    /**
     * @return bool
     */
    public function commit(): bool
    {
        return $this->connection->commit();
    }

    /**
     * @param bool $autocommit
     *
     * @return bool
     */
    public function setAutocommit(bool $autocommit = false): bool
    {
        return $this->connection->autocommit($autocommit);
    }

    /**
     * @param $statement
     *
     * @return array
     *
     * @throws DatabaseException
     */
    private function getResult($statement): array
    {
        $result = $statement->get_result();

        if (!$result) {
            throw new DatabaseException($statement->error, $statement->errno);
        }

        return $this->getAssociativeResult($result);
    }

    /**
     * @param $result
     *
     * @return array
     */
    private function getAssociativeResult($result): array
    {
        $resultArray = [];

        while ($row = $result->fetch_assoc()) {
            $resultArray[] = $row;
        }

        $result->free();

        return $resultArray;
    }

    /**
     * @param $query
     * @param $bindings
     *
     * @throws InvalidBindingException
     */
    private function bindingResolver(&$query, &$bindings)
    {
        $firstKey = key($bindings);

        if (isset($firstKey) && !is_int($firstKey)) {
            $matches = [];

            preg_match_all('/:(\w+)/', $query, $matches);

            $query       = preg_replace('/:\w+/', '?', $query);
            $newBindings = [];

            foreach ($matches[1] as $paramName) {
                if (!array_key_exists($paramName, $bindings)) {
                    throw new InvalidBindingException('Error resolve name binding [paramName: ' . $paramName . ']');
                }

                $newBindings[] = $bindings[$paramName];
            }

            $bindings = $newBindings;
        }
    }

    /**
     * @param $statement
     * @param array $bindings
     *
     * @throws DatabaseException
     */
    private function bind($statement, array $bindings = [])
    {
        if (!empty($bindings)) {
            $types                = '';
            $referenceForBindings = [];

            foreach ($bindings as $bindingIndex => $bindValue) {
                $types                  .= $this->determineType($bindValue);
                $referenceForBindings[] = &$bindings[$bindingIndex];
            }

            array_unshift($referenceForBindings, $types);

            if (!call_user_func_array([$statement, 'bind_param'], $referenceForBindings)) {
                throw new DatabaseException($statement->error, $statement->errno);
            }
        }
    }

    /**
     * @param $item
     *
     * @return string
     */
    private function determineType($item): string
    {
        switch (gettype($item)) {
            case 'boolean':
            case 'integer':
                $type = 'i';
                break;
            case 'blob':
                $type = 'b';
                break;
            case 'double':
                $type = 'd';
                break;
            case 'NULL':
            case 'string':
            default:
                $type = 's';
                break;
        }

        return $type;
    }

    /**
     * @throws DatabaseException
     */
    private function initConnection()
    {
        $connection = new \mysqli();
        $connection->init();
        $connection->real_connect(
            $this->config['hostname'],
            $this->config['username'],
            $this->config['password'],
            $this->config['database'],
        );
        if ($connection->connect_error) {
            throw new DatabaseException($connection->connect_error, $connection->connect_errno);
        }

        $this->connection = $connection;
    }
}
