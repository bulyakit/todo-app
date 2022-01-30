<?php

declare(strict_types=1);

namespace ToDoApp\Bootstrap;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Log\InvalidArgumentException;
use Slim\App;
use ToDoApp\Database\Contract\ConnectionInterface;
use ToDoApp\Database\Service\Connection;
use ToDoApp\DataBase\Exception\DatabaseException;
use ToDoApp\Route\Routing;

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
//        $this->initLogger();
//        $this->initHttpClient();
//        $this->initTemplateEngine();
//        $this->initHandlers();
//        $this->initMiddleware();
        $this->initRouting();
    }

    /**
     * Sets the environment of API.
     */
    private function initEnvironment(): void
    {
        $container = $this->application->getContainer();
        $settings  = $container->get('settings');

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

        $databaseSettings  = $settings['database']['default'];

        $connection = new Connection($databaseSettings);

//        $connectionManager = new ConnectionManager();
//        $queryLogAdapter   = new PhpArrayAdapter();
//        $queryLogger       = new QueryLogger($queryLogAdapter);
//        $resolver          = new MysqliNameBindingResolver();
//        foreach ($databaseSettings as $connectionName => $connectionSettings) {
//            $connectionConfig = new ConnectionConfig(
//                $connectionSettings['database'],
//                $connectionSettings['username'],
//                $connectionSettings['password']
//            );
//            $connectionConfig->setHostname($connectionSettings['hostname']);
//            $connectionConfig->setTimezone($connectionSettings['timezone']);
//
//            $adapter    = new MysqliAdapter($connectionConfig, $resolver);
//            $connection = new ConnectionService($adapter, $queryLogger);
//
//            $connectionManager->add($connectionName, $connection);
//        }

//        $container[ConnectionManager::class] = $connectionManager;
        $container[ConnectionInterface::class] = $connection;
    }

    /**
     * @throws InvalidArgumentException
     */
    private function initLogger(): void
    {
        $container = $this->application->getContainer();
        $settings  = $container->get('settings');
        if (!isset($settings['logger'])) {
            throw new InvalidArgumentException('The logger section is missing from settings');
        }

        $loggerSettings = $settings['logger'];
        $logger         = new Logger($loggerSettings['name']);
        $syslogHandler  = new SyslogHandler(
            $loggerSettings['ident'],
            $loggerSettings['facility'],
            $loggerSettings['level'],
            $loggerSettings['bubble'],
            $loggerSettings['logopts']
        );
        // $syslogHandler->setFormatter();
        $introspectionProcessor = new IntrospectionProcessor();
        $webProcessor           = new WebProcessor();

        $logger->pushHandler($syslogHandler);
        $logger->pushProcessor($introspectionProcessor);
        $logger->pushProcessor($webProcessor);

        $container[LoggerInterface::class] = $logger;
    }

    private function initHttpClient()
    {
        $container = $this->application->getContainer();
        $container[ClientInterface::class] = new Client();
    }

    private function initTemplateEngine(): void
    {
        $container                                 = $this->application->getContainer();
        $container[TemplateEngineInterface::class] = new Twig();
    }

    /**
     * Initialize handlers.
     */
    private function initHandlers(): void
    {
        $container = $this->application->getContainer();

        // Error Handling
        $container['errorHandler'] = function () {
            return new ErrorHandler();
        };
        $container['notFoundHandler'] = function () {
            return new NotFoundHandler();
        };

        // Event handling
        $container[EventManagerInterface::class] = new EventManager();
    }

    /**
     * Initialize middleware.
     */
    private function initMiddleware(): void
    {
        $container = $this->application->getContainer();

        $routeGuard = new RouteGuard($container);
        $this->application->add($routeGuard);

        /** @var ContainerInterface $container */
        $cliRunner = new SlimCliRunner($container);
        $this->application->add($cliRunner);

        $tokenValidator = new TokenValidator($container);
        $this->application->add($tokenValidator);

        $serviceInitializer = new ServiceInitializer($container);
        $this->application->add($serviceInitializer);

        $eventListener = new EventInitializer($container);
        $this->application->add($eventListener);

        $cors = new Cors($container);
        $this->application->add($cors);
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
