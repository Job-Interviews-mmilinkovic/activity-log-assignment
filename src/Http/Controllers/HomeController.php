<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\HtmlResponse;

class HomeController
{
    public function index(ServerRequestInterface $request): HtmlResponse
    {
        return new HtmlResponse('<h1>Welcome</h1><p><a href="/hello/World">Say hello</a></p>');
    }

    public function greet(ServerRequestInterface $request, array $vars): HtmlResponse
    {
        $name = htmlspecialchars($vars['name']);
        return new HtmlResponse("<h1>Hello, {$name}!</h1>");
    }
}
