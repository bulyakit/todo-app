<?php

namespace App\Apps\ToDo\Presentation\Controller;

use App\Apps\ToDo\Application\Contract\ToDoServiceInterface;
use App\Apps\ToDo\Application\Service\ToDoService;
use App\Apps\ToDo\Presentation\Formatter\ToDoResponseFormatter;
use App\Apps\ToDo\Presentation\Mapper\ToDoParamsMapper;
use App\Apps\ToDo\Presentation\Validator\ToDoRequestValidator;
use App\Database\Contract\ConnectionInterface;
use App\Database\Exception\DatabaseException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Scalar\ValueObject\Boolean\BooleanValue;
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
     * @throws DatabaseException
     */
    public function doAdd(RequestInterface $request, ResponseInterface $response, array $args = []): ResponseInterface
    {
        $service = $this->getService();
        $params = $this->getParams($request, $args);

        $validator = new ToDoRequestValidator();
        $validator->validateAdd($params);
        $mapper = new ToDoParamsMapper();
        $mappedParams = $mapper->mapAdd($params);
        $service->add($mappedParams[0], $mappedParams[1], new BooleanValue(false));
//        $data = $this->doIt($status, $request, $args, [
//            Callback::VALIDATOR => [new ToDoRequestValidator(), 'validateAdd'],
//            Callback::MAPPER    => [new ToDoParamsMapper(), 'mapAdd'],
//            Callback::SERVICE   => [$service, 'add'],
//            Callback::FORMATTER => [new ToDoResponseFormatter(), 'formatAdd'],
//        ]);
//
        return $this->render($request, $response, $args);
    }


    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     *
     * @return ResponseInterface
     * @throws DatabaseException
     */
    public function doGetAll(
        RequestInterface $request,
        ResponseInterface $response,
        array $args = []
    ): ResponseInterface {

        $service = $this->getService();

        $result = $service->getAll();

        $formatter = new TodoResponseFormatter();


        $data = $formatter->formatGetAll($result);


//        $params = $this->getParams($request, $args);
//
//        var_dump($params);

//        $status = "OK"; //TODO check this
//        $data = $this->doIt($status, $request, $args, [
//            Callback::SERVICE   => [$service, 'getAll'],
//            Callback::FORMATTER => [new ToDoResponseFormatter(), 'formatGetAll'],
//        ]);

        return $this->render($request, $response, $args, $data);
    }

    /**
     * @return ToDoService
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function getService(): ToDoService
    {
        /** @var ToDoServiceInterface $service */
//        $config = include(__DIR__ . '/../Config/settings.php');
//        $dbConfig = $config['settings']['database'];
//        $connection = new Connection($dbConfig);

        $connection = $this->container->get(ConnectionInterface::class);

        return new ToDoService($connection);
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @param array $data
     * @param int $status
     * @param int $encodingOptions
     *
     * @return ResponseInterface
     */
    private function render(
        RequestInterface $request,
        ResponseInterface $response,
        array $args = [],
        array $data = [],
        int $status = 200,
        int $encodingOptions = 0
    ): ResponseInterface {
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
