<?php

namespace App\Apps\ToDo\Presentation\Controller;

use Psr\Container\ContainerInterface;

/**
 * Class AbstractController
 */
abstract class AbstractController
{
    /**
     * Sensitive data fields.
     *
     * @var array
     */
    protected array $sensitiveFields = [
        'password',
        'oldPassword',
        'newPassword',
        'confirmedPassword',
    ];

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

//    /**
//     * @param RequestInterface $request
//     * @param array $args
//     *
//     * @return array
//     */
//    protected function getParams(RequestInterface $request, array $args = []): array
//    {
//        /** @var Request $request */
//        $parsedBody = (array)$request->getParsedBody();
//
//        return array_merge($args, $parsedBody);
//    }

//    /**
//     * @param string $status
//     * @param RequestInterface $request
//     * @param array $args
//     * @param array $callbacks
//     *
//     * @return array
//     */
//    protected function doIt(string &$status, RequestInterface $request, array $args = [], array $callbacks = []): array
//    {
//        $data   = [];
//        $status = HttpStatusCode::OK;
//        $params = $this->getParams($request, $args);
//
//        if (isset($callbacks[Callback::VALIDATOR])) {
//            $callbacks[Callback::VALIDATOR]($params);
//        }
//
//        $response = null;
//        if (isset($callbacks[Callback::SERVICE])) {
//            $input = [];
//            if (isset($callbacks[Callback::MAPPER])) {
//                $input = $callbacks[Callback::MAPPER]($params);
//            }
//            /** @throws InvalidRequestException */
//            $response = $callbacks[Callback::SERVICE](...$input);
//        }
//
//        if ($response && isset($callbacks[Callback::FORMATTER])) {
//            $data = $callbacks[Callback::FORMATTER]($response);
//        }
//
//        return $data;
//    }

//    /**
//     * @param RequestInterface $request
//     * @param ResponseInterface $response
//     * @param array $args
//     * @param array $data
//     * @param int $status
//     * @param int $encodingOptions
//     *
//     * @return ResponseInterface
//     */
//    protected function render(
//        RequestInterface $request,
//        ResponseInterface $response,
//        array $args = [],
//        array $data = [],
//        int $status = HttpStatusCode::OK,
//        int $encodingOptions = 0
//    ): ResponseInterface {
//        /** @var Response $response */
//        return $response->withJson(
//            [
//                'params' => $this->removeSensitiveFields($this->getParams($request, $args)),
//                'data'   => $data,
//            ],
//            $status,
//            $encodingOptions
//        );
//    }
//
//    /**
//     * @param array $params
//     *
//     * @return array
//     */
//    protected function removeSensitiveFields(array $params): array
//    {
//        foreach ($this->sensitiveFields as $sensitiveField) {
//            if (isset($params[$sensitiveField])) {
//                $params[$sensitiveField] = 'X';
//            }
//        }
//
//        return $params;
//    }
}
