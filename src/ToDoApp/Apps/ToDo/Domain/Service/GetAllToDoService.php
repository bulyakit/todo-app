<?php

namespace ToDoApp\Apps\ToDo\Domain\Service;


use ToDoApp\Apps\ToDo\Application\Collection\ToDoCollection;
use ToDoApp\Apps\ToDo\Domain\Aggregate\ToDo;
use ToDoApp\Apps\ToDo\Infrastructure\Persistence\Repository\ToDoRepository;
use ToDoApp\Scalar\Exception\InvalidCollectionItemException;

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
     * GetAllUserService constructor.
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
        $toDo = new ToDo('getAll');
        $toDoCollection = new ToDoCollection;
        $toDoCollection->add('first', $toDo);
//        return $toDoCollection;

        return $this->repository->getAll();
    }
}
