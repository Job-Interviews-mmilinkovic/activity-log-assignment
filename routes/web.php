<?php

declare(strict_types=1);

use FastRoute\RouteCollector;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CowController;
use App\Http\Controllers\DownloadController;
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

// Cow
$r->addRoute('GET', '/cow', [CowController::class, 'index']);
$r->addRoute('POST', '/cow', [CowController::class, 'buy']);

// Download
$r->addRoute('GET', '/download', [DownloadController::class, 'index']);
$r->addRoute('POST', '/download', [DownloadController::class, 'download']);

// Admin
$r->addRoute('GET', '/admin/stats', [AdminController::class, 'stats']);
$r->addRoute('GET', '/admin/reports', [AdminController::class, 'reports']);
