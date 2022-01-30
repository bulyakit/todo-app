<?php

namespace App\Route;

use Slim\App;

/**
 * Class Routing
 */
class Routing
{
    /**
     * @var App
     */
    private App $application;

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
        $this->application->options('/{routes:.+}', function ($request, $response) {
            return $response;
        })->setName('cors');

        (new ToDoRouting($this->application))->initialize();
    }
}
