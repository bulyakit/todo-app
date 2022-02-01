<?php

namespace App\Apps\ToDo\Domain\Service;

use App\Apps\ToDo\Application\Collection\ToDoCollection;
use App\Apps\ToDo\Infrastructure\Persistence\Repository\ToDoRepository;
use App\Scalar\Exception\InvalidCollectionItemException;

/**
 * Class GetAllToDoService
 */
class GetAllToDoService
{
    /**
     * @var ToDoRepository
     */
    private ToDoRepository $repository;

    /**
     * GetAllToDoService constructor.
     *
     * @param ToDoRepository $repository
     */
    public function __construct(ToDoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return ToDoCollection
     * @throws InvalidCollectionItemException
     */
    public function getAll(): ToDoCollection
    {
        return $this->repository->getAll();
    }
}
