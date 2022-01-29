<?php

namespace ToDoApp\Core\Contract;

use DI\Container;
use DI\ContainerBuilder;
use Exception;
use Livita\Scalar\ValueObject\Numeric\UnsignedInteger;
use Psr\Container\ContainerInterface;
use Zend\EventManager\EventManagerInterface;

/**
 * Class ApplicationServiceAbstract
 */
abstract class ApplicationServiceAbstract
{
    /**
     * @var string
     */
    protected const AUTHORIZED_USER_ID = 'authorizedUserId';

    /**
     * @var ContainerInterface
     */
    protected $diContainer;

    /**
     * @var ContainerInterface
     */
    protected $serviceLocator;

    /**
     * @param ContainerInterface $serviceLocator
     */
    final public function __construct(ContainerInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        $this->diContainer    = $this->buildDiContainer();
    }

    /**
     * @noinspection PhpDocMissingThrowsInspection
     *
     * @return UnsignedInteger
     */
    final protected function getAuthorizedUserId(): UnsignedInteger
    {
        try {
            $authorizedUserId = $this->serviceLocator->get(static::AUTHORIZED_USER_ID);
        } catch (Exception $e) {
            /** @noinspection PhpUnhandledExceptionInspection */
            $authorizedUserId = new UnsignedInteger(1);
        }

        return $authorizedUserId;
    }

    /**
     * @param string $event
     * @param array $params
     */
    final protected function fire(string $event, array $params = [])
    {
        try {
            $this->serviceLocator->get(EventManagerInterface::class)->trigger($event, null, $params);
        } catch (Exception $e) {
            // Log failed.
        }
    }

    /**
     * @return array
     */
    protected function getDiDefinitions(): array
    {
        return [];
    }

    /**
     * @return ContainerInterface
     */
    private function buildDiContainer(): ContainerInterface
    {
        try {
            $diContainerBuilder = new ContainerBuilder();
            $diContainerBuilder->addDefinitions($this->getDiDefinitions());
            $diContainer = $diContainerBuilder->build();
        } catch (Exception $e) {
            $diContainer = new Container();
        }

        return $diContainer;
    }
}
