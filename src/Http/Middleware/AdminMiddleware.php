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

class AdminMiddleware implements MiddlewareInterface
{
    private const ADMIN_PREFIX = '/admin';
    private const LOGIN_PATH = '/login';
    private const ADMIN_ROLE = 'admin';
    private const HOME_PATH = '/';

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $path = $request->getUri()->getPath();

        if (str_starts_with($path, self::ADMIN_PREFIX)) {
            $auth = Auth::instance();
            $currentUser = $auth->getCurrentUser();

            if (!$currentUser) {
                return new RedirectResponse(self::LOGIN_PATH);
            }

            $user = User::find($currentUser['id']);

            if (!$user || !$user->role || $user->role->name !== self::ADMIN_ROLE) {
                return new RedirectResponse(self::HOME_PATH);
            }
        }

        return $handler->handle($request);
    }
}
