<?php

namespace ToDoApp\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ToDoApp\Apps\ToDo\Application\Contract\ToDoServiceInterface;
use ToDoApp\Apps\ToDo\Application\Service\ToDoService;
use ToDoApp\Catalog\Callback;
use ToDoApp\DataBase\Exception\DatabaseException;
use ToDoApp\Database\Service\Connection;
use ToDoApp\Formatter\ToDoResponseFormatter;
use ToDoApp\Mapper\ToDoParamsMapper;
use ToDoApp\Validator\ToDoRequestValidator;

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
$status = "OK"; //TODO check this

        $data = $this->doIt($status, $request, $args, [
            Callback::VALIDATOR => [new ToDoRequestValidator(), 'validateAdd'],
            Callback::MAPPER    => [new ToDoParamsMapper(), 'mapAdd'],
            Callback::SERVICE   => [$service, 'add'],
            Callback::FORMATTER => [new ToDoResponseFormatter(), 'formatAdd'],
        ]);

        return $this->render($request, $response, $args, $data, $status);
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

$status = "OK"; //TODO check this
        $data = $this->doIt($status, $request, $args, [
            Callback::SERVICE   => [$service, 'getAll'],
            Callback::FORMATTER => [new ToDoResponseFormatter(), 'formatGetAll'],
        ]);

        return $this->render($request, $response, $args, $data, $status);
    }

    /**
     * @return ToDoService
     * @throws DatabaseException
     */
    private function getService(): ToDoService
    {
        /** @var ToDoServiceInterface $service */
        $config = include(__DIR__ . '/../Config/settings.php');
        $dbConfig = $config['settings']['database'];
        $connection = new Connection($dbConfig);

        return new ToDoService($connection);
    }
}
