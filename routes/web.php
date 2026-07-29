<?php

declare(strict_types=1);

use App\Http\Controllers\HomeController;

$r->addRoute('GET', '/', [HomeController::class, 'index']);
$r->addRoute('GET', '/hello/{name}', [HomeController::class, 'greet']);
