<?php

namespace ToDoApp\Route;

use Slim\App;
use ToDoApp\Apps\ToDo\Presentation\Controller\ToDoController;

/**
 * Class ToDoRouting
 */
class ToDoRouting
{
    /**
     * @var App
     */
    protected App $application;

    /**
     * Routing constructor.
     *
     * @param App $application
     */
    public function __construct(App $application)
    {
        $this->application = $application;
    }

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
