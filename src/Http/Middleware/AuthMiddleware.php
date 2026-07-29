<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Bootstrap\Auth;
use App\Models\User;
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

        $auth = Auth::instance();

        if (!in_array($path, $this->publicPaths, true) && !$auth->isLogged()) {
            return new RedirectResponse('/login');
        }

        if (str_starts_with($path, '/admin')) {
            $currentUser = $auth->getCurrentUser();

            if (!$currentUser) {
                return new RedirectResponse('/login');
            }

            $user = User::find($currentUser['id']);

            if (!$user || !$user->role || $user->role->name !== 'admin') {
                return new RedirectResponse('/');
            }
        }

        return $handler->handle($request);
    }
}
