<?php

namespace App\Apps\ToDo\Domain\Service;

use App\Apps\ToDo\Application\Collection\ToDoCollection;
use App\Apps\ToDo\Domain\Contract\ToDoRepositoryInterface;

/**
 * Class GetAllToDoService
 */
class GetAllToDoService
{
    /**
     * @var ToDoRepositoryInterface
     */
    private ToDoRepositoryInterface $repository;

    /**
     * GetAllToDoService constructor.
     *
     * @param ToDoRepositoryInterface $repository
     */
    public function __construct(ToDoRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return ToDoCollection
     */
    public function getAll(): ToDoCollection
    {
        return $this->repository->getAll();
    }
}
