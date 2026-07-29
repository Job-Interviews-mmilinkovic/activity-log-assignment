<?php

declare(strict_types=1);

namespace App\Bootstrap;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Router implements RequestHandlerInterface
{
    private Dispatcher $dispatcher;

    public function __construct()
    {
        $this->dispatcher = \FastRoute\simpleDispatcher(function (RouteCollector $r) {
            require __DIR__ . '/../routes/web.php';
        });
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $routeInfo = $this->dispatcher->dispatch(
            $request->getMethod(),
            $request->getUri()->getPath()
        );

        return match ($routeInfo[0]) {
            Dispatcher::NOT_FOUND => new Response\HtmlResponse('<h1>404 Not Found</h1>', 404),
            Dispatcher::METHOD_NOT_ALLOWED => new Response\HtmlResponse('<h1>405 Method Not Allowed</h1>', 405),
            Dispatcher::FOUND => $this->callHandler($routeInfo[1], $request, $routeInfo[2]),
        };
    }

    private function callHandler(array $handler, ServerRequestInterface $request, array $vars): ResponseInterface
    {
        [$class, $method] = $handler;
        $controller = new $class();
        return $controller->$method($request, $vars);
    }
}
