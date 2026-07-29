<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Bootstrap\Auth;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ServerRequestInterface;

class HomeController
{
    public function index(ServerRequestInterface $request): HtmlResponse
    {
        $user = Auth::instance()->getCurrentUser();

        $name = $user['name'] ?? 'Guest';
        $email = $user['email'] ?? '';

        $html = "<h1>Welcome, {$name}!</h1>
            <p>Logged in as: {$email}</p>
            <p><a href='/hello/World'>Say hello</a></p>
            <form method='post' action='/logout'><button type='submit'>Logout</button></form>";

        return new HtmlResponse($html);
    }

    public function greet(ServerRequestInterface $request, array $vars): HtmlResponse
    {
        $name = htmlspecialchars($vars['name']);
        return new HtmlResponse("<h1>Hello, {$name}!</h1><p><a href='/'>Back</a></p>");
    }
}
