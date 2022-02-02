<?php

declare(strict_types=1);

namespace App\Bootstrap;

use App\Database\Contract\ConnectionInterface;
use App\Database\Exception\DatabaseException;
use App\Database\Service\Connection;
use App\Route\Routing;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Log\InvalidArgumentException;
use Slim\App;

/**
 * Class Bootstrap
 */
class Bootstrap
{
    /**
     * @var App
     */
    private App $application;

    /**
     * Bootstrap constructor.
     *
     * @param App $application
     */
    public function __construct(App $application)
    {
        $this->application = $application;
    }

    /**
     * Initialize components.
     *
     * @throws ContainerExceptionInterface
     * @throws DatabaseException
     * @throws NotFoundExceptionInterface
     */
    public function initialize(): void
    {
        $this->initEnvironment();
        $this->initConnections();
        $this->initRouting();
    }

    /**
     * Sets the environment of API.
     */
    private function initEnvironment(): void
    {
        $container = $this->application->getContainer();
        try {
            $settings = $container->get('settings');
        } catch (NotFoundExceptionInterface | ContainerExceptionInterface $e) {
        }

        $defaultTimeZone = $settings['defaultTimeZone'] ?? 'UTC';

        date_default_timezone_set($defaultTimeZone);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws DatabaseException
     */
    private function initConnections(): void
    {
        $container = $this->application->getContainer();
        $settings  = $container->get('settings');
        if (!isset($settings['database']['default'])) {
            throw new InvalidArgumentException('The default database section is missing from settings');
        }
        $databaseSettings = $settings['database']['default'];

        $connection                            = new Connection($databaseSettings);
        $container[ConnectionInterface::class] = $connection;
    }

    /**
     * Initialize routing.
     */
    private function initRouting(): void
    {
        $routing = new Routing($this->application);
        $routing->initialize();
    }
}
