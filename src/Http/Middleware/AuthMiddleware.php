<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;

class AuthMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $userId = $_SESSION['user_id'] ?? null;

        if ($userId === null) {
            return new HtmlResponse('<h1>401 Unauthorized</h1><p>Please log in.</p>', 401);
        }

        return $handler->handle($request->withAttribute('user_id', $userId));
    }
}
