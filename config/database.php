<?php

declare(strict_types=1);

return [
    'driver'    => $_ENV['DB_DRIVER'] ?? getenv('DB_DRIVER') ?: 'mysql',
    'host'      => $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?: 'mysql',
    'port'      => $_ENV['DB_PORT'] ?? getenv('DB_PORT') ?: '3306',
    'database'  => $_ENV['DB_DATABASE'] ?? getenv('DB_DATABASE') ?: 'activity_log',
    'username'  => $_ENV['DB_USERNAME'] ?? getenv('DB_USERNAME') ?: 'app',
    'password'  => $_ENV['DB_PASSWORD'] ?? getenv('DB_PASSWORD') ?: 'app_secret',
    'charset'   => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix'    => '',
];
