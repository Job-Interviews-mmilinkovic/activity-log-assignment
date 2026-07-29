<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Bootstrap\Auth;
use App\Events\CowPageVisitedEvent;
use App\Events\DownloadPageVisitedEvent;
use App\Events\EventDispatcher;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PageViewLogger implements MiddlewareInterface
{
    private array $pageEvents = [
        '/cow'      => CowPageVisitedEvent::class,
        '/download' => DownloadPageVisitedEvent::class,
    ];

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $path = $request->getUri()->getPath();

        if (isset($this->pageEvents[$path])) {
            $userId = (int) (Auth::instance()->getCurrentUser()['id'] ?? 0);

            if ($userId > 0) {
                $eventClass = $this->pageEvents[$path];
                EventDispatcher::instance()?->dispatch(new $eventClass($userId));
            }
        }

        return $handler->handle($request);
    }
}
