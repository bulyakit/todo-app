<?php

namespace ToDoApp\Route;

use ToDoApp\Controller\ToDoController;

/**
 * Class ToDoRouting
 */
class ToDoRouting extends AbstractRouting
{
    /**
     * Initialize routes.
     */
    public function initialize()
    {
        $this->application->post(
            '/v1/todo-handler/add-service',
            ToDoController::class . ':doAdd'
        );

        $this->application->get(
            '/v1/todo-handler/get-all-todos',
            ToDoController::class . ':doGetAll'
        );
    }
}
