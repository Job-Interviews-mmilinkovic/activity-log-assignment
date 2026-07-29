<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface;

class HomeController extends BaseController
{
    public function index(ServerRequestInterface $request): \Laminas\Diactoros\Response\HtmlResponse
    {
        return $this->render('home/index');
    }

    public function greet(ServerRequestInterface $request, array $vars): \Laminas\Diactoros\Response\HtmlResponse
    {
        return $this->render('home/greet', ['name' => htmlspecialchars($vars['name'])]);
    }
}
