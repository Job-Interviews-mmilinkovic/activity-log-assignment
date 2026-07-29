<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Bootstrap\Auth;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthMiddleware implements MiddlewareInterface
{
    private array $publicPaths = ['/login', '/register'];

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $path = $request->getUri()->getPath();

        if (!in_array($path, $this->publicPaths, true) && !Auth::instance()->isLogged()) {
            return new RedirectResponse('/login');
        }

        return $handler->handle($request);
    }
}
