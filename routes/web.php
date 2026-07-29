<?php

declare(strict_types=1);

use FastRoute\RouteCollector;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

// Auth
$r->addRoute('GET', '/login', [AuthController::class, 'loginForm']);
$r->addRoute('POST', '/login', [AuthController::class, 'login']);
$r->addRoute('GET', '/register', [AuthController::class, 'registerForm']);
$r->addRoute('POST', '/register', [AuthController::class, 'register']);
$r->addRoute('POST', '/logout', [AuthController::class, 'logout']);

// Pages
$r->addRoute('GET', '/', [HomeController::class, 'index']);
$r->addRoute('GET', '/hello/{name}', [HomeController::class, 'greet']);
