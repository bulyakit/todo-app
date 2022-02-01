<?php

namespace App\Apps\ToDo\Presentation\Controller;

use App\Apps\ToDo\Application\Service\ToDoService;
use App\Apps\ToDo\Presentation\Formatter\ToDoResponseFormatter;
use App\Apps\ToDo\Presentation\Mapper\ToDoParamsMapper;
use App\Apps\ToDo\Presentation\Validator\ToDoRequestValidator;
use App\Database\Contract\ConnectionInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Scalar\Exception\InvalidCollectionItemException;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class ToDoController
 */
class ToDoController extends AbstractController
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     *
     * @return ResponseInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function doAdd(RequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $params    = $this->getParams($request, $args);
        $validator = new ToDoRequestValidator();
        $validator->validateAdd($params);

        $mapper       = new ToDoParamsMapper();
        $mappedParams = $mapper->mapAdd($params);
        $service      = $this->getService();
        $service->add($mappedParams[0], $mappedParams[1]);

        return $this->render($request, $response, $args);
    }


    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     *
     * @return ResponseInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws InvalidCollectionItemException
     * @throws \Exception
     */
    public function doGetAll(
        RequestInterface $request,
        ResponseInterface $response,
        array $args = []
    ): ResponseInterface {
        $service   = $this->getService();
        $result    = $service->getAll();
        $formatter = new TodoResponseFormatter();
        $data      = $formatter->formatGetAll($result);

        return $this->render($request, $response, $args, $data);
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     *
     * @return ResponseInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function doSetDone(
        RequestInterface $request,
        ResponseInterface $response,
        array $args = []
    ): ResponseInterface {
        $params    = $this->getParams($request, $args);
        $validator = new ToDoRequestValidator();
        $validator->validateSetDone($params);

        $mapper       = new ToDoParamsMapper();
        $mappedParams = $mapper->mapSetDone($params);

        $service   = $this->getService();
        $service->setDone($mappedParams[0]);

        return $this->render($request, $response, $args);
    }


    /**
     * @return ToDoService
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function getService(): ToDoService
    {
        $connection = $this->container->get(ConnectionInterface::class);

        return new ToDoService($connection);
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @param array $data
     *
     * @return ResponseInterface
     */
    private function render(
        RequestInterface $request,
        ResponseInterface $response,
        array $args = [],
        array $data = []
    ): ResponseInterface {
        $status = 200;
        $encodingOptions = 0;
        /** @var Response $response */
        return $response->withJson(
            [
                'params' => $this->getParams($request, $args),
                'data'   => $data,
            ],
            $status,
            $encodingOptions
        );
    }

    /**
     * @param RequestInterface $request
     * @param array $args
     *
     * @return array
     */
    protected function getParams(RequestInterface $request, array $args = []): array
    {
        /** @var Request $request */
        $parsedBody = (array)$request->getParsedBody();

        return array_merge($args, $parsedBody);
    }
}
