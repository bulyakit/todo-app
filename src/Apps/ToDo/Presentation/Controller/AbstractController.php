<?php

namespace App\Apps\ToDo\Presentation\Controller;

use Psr\Container\ContainerInterface;

/**
 * Class AbstractController
 */
abstract class AbstractController
{
     /**
     * @var ContainerInterface
     */
    protected ContainerInterface $container;

    /**
     * AbstractController constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}
