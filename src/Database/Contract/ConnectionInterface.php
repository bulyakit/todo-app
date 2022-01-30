<?php

namespace App\Database\Contract;

interface ConnectionInterface
{
    /**
     * @param string $query
     * @param array $bindings
     * @param int $cacheTime
     *
     * @return array|null
     */
    public function selectOne(string $query, array $bindings = [], int $cacheTime = 0): ?array;

    /**
     * @param string $query
     * @param array $bindings
     * @param int $cacheTime
     *
     * @return array
     */
    public function select(string $query, array $bindings = [], int $cacheTime = 0): array;

    /**
     * @param string $query
     *
     * @return bool|array
     */
    public function query(string $query);

    /**
     * @param string $query
     * @param array $bindings
     *
     * @return int
     */
    public function insert(string $query, array $bindings = []): int;

    /**
     * @return bool
     */
    public function beginTransaction(): bool;

    /**
     * @return bool
     */
    public function rollback(): bool;

    /**
     * @return bool
     */
    public function commit(): bool;

    /**
     * @param bool $autocommit
     *
     * @return bool
     */
    public function setAutocommit(bool $autocommit = false): bool;

    /**
     * @param $statement
     *
     * @return int
     */
    public function getLastInsertId($statement): int;

    /**
     * @param string $query
     * @param array $bindings
     *
     * @return int
     */
    public function update(string $query, array $bindings = []): int;

    /**
     * @param string $query
     * @param array $bindings
     *
     * @return int
     */
    public function delete(string $query, array $bindings = []): int;

    /**
     * @param $statement
     *
     * @return int
     */
    public function getAffectedRows($statement): int;

    /**
     * @return mixed
     */
    public function ping();

    /**
     * @return mixed
     */
    public function reconnect();
}
