<?php

declare(strict_types=1);

namespace App\Bootstrap;

use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Relay\Relay;

class Kernel
{
    public function run(): void
    {
        session_start();

        $request = ServerRequestFactory::fromGlobals();

        $middlewareQueue = [
            new \App\Http\Middleware\AuthMiddleware(),
            new \App\Bootstrap\Router(),
        ];

        $relay = new Relay($middlewareQueue);
        $response = $relay->handle($request);

        (new SapiEmitter())->emit($response);
    }
}
