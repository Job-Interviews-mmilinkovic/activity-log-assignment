<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CsrfMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (!in_array($request->getMethod(), ['POST', 'PUT', 'DELETE', 'PATCH'], true)) {
            return $handler->handle($request);
        }

        $body = $request->getParsedBody();
        $token = is_array($body) ? ($body['_token'] ?? null) : null;

        if ($token === null || $token !== ($_SESSION['_csrf_token'] ?? null)) {
            $response = new Response();
            $response->getBody()->write('<h1>419 Page Expired</h1><p>CSRF token mismatch. <a href="javascript:history.back()">Go back</a></p>');
            return $response->withStatus(419);
        }

        return $handler->handle($request);
    }
}
