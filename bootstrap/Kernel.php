<?php

declare(strict_types=1);

namespace App\Bootstrap;

use App\Bootstrap\Container;
use App\Events\EventDispatcher;
use App\Events\CowPageVisitedEvent;
use App\Events\DownloadPageVisitedEvent;
use App\Events\UserBoughtCowEvent;
use App\Events\UserDownloadedFileEvent;
use App\Events\UserLoggedInEvent;
use App\Events\UserLoggedOutEvent;
use App\Events\UserRegisteredEvent;
use App\Listeners\CowPageVisitedListener;
use App\Listeners\DownloadPageVisitedListener;
use App\Listeners\UserBoughtCowListener;
use App\Listeners\UserDownloadedFileListener;
use App\Listeners\UserLoggedInListener;
use App\Listeners\UserLoggedOutListener;
use App\Listeners\UserRegisteredListener;
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
        DatabaseManager::boot();

        $container = new Container();
        $container->bind(ValidatorServiceInterface::class, ValidatorService::class);

        $dispatcher = new EventDispatcher($container);
        $dispatcher->listen(CowPageVisitedEvent::class, CowPageVisitedListener::class);
        $dispatcher->listen(DownloadPageVisitedEvent::class, DownloadPageVisitedListener::class);
        $dispatcher->listen(UserBoughtCowEvent::class, UserBoughtCowListener::class);
        $dispatcher->listen(UserDownloadedFileEvent::class, UserDownloadedFileListener::class);
        $dispatcher->listen(UserLoggedInEvent::class, UserLoggedInListener::class);
        $dispatcher->listen(UserLoggedOutEvent::class, UserLoggedOutListener::class);
        $dispatcher->listen(UserRegisteredEvent::class, UserRegisteredListener::class);
        EventDispatcher::setInstance($dispatcher);
        $container->bind(EventDispatcher::class, EventDispatcher::class);
        $container->setInstance(EventDispatcher::class, $dispatcher);

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
