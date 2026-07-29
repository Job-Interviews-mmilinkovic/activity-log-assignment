<?php

declare(strict_types=1);

namespace App\Bootstrap;

use App\Container\Container;
use App\Services\ValidationService\Contracts\ValidatorServiceInterface;
use App\Services\ValidationService\ValidatorService;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Relay\Relay;

class Kernel
{
    public function run(): void
    {
        session_start();

        $container = new Container();
        $container->bind(ValidatorServiceInterface::class, ValidatorService::class);

        $request = ServerRequestFactory::fromGlobals();

        $middlewareQueue = [
            new \App\Http\Middleware\AuthMiddleware(),
            new Router($container),
        ];

        $relay = new Relay($middlewareQueue);
        $response = $relay->handle($request);

        (new SapiEmitter())->emit($response);
    }
}
