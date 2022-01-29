<?php

namespace ToDoApp\Route;

use Slim\App;

/**
 * Class AbstractRouting
 *
 * @package Livita\LivitApi
 */
abstract class AbstractRouting
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
     * Initializes the routes.
     */
    abstract public function initialize();
}
