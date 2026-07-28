<?php

declare(strict_types=1);

if (!function_exists('env')) {
    function env(string $key, mixed $default = null): mixed
    {
        return $_ENV[$key] ?? getenv($key) ?: $default;
    }
}

if (!function_exists('config')) {
    function config(string $key): mixed
    {
        static $loaded = [];
        $parts = explode('.', $key);
        $file = $parts[0];
        $path = __DIR__ . '/../config/' . $file . '.php';

        if (!isset($loaded[$file])) {
            $loaded[$file] = file_exists($path) ? require $path : [];
        }

        $value = $loaded[$file];
        for ($i = 1; $i < count($parts); $i++) {
            $value = $value[$parts[$i]] ?? null;
        }

        return $value;
    }
}
