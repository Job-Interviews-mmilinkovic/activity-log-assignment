<?php

declare(strict_types=1);

namespace App\Database;

use Illuminate\Database\Capsule\Manager as Capsule;

abstract class Seeder
{
    public function __construct()
    {
        DatabaseManager::boot();
    }

    abstract public function run(): void;

    protected function call(array $seeders): void
    {
        foreach ($seeders as $seeder) {
            $instance = new $seeder();
            $instance->run();
        }
    }

    protected function table(string $name): \Illuminate\Database\Query\Builder
    {
        return Capsule::table($name);
    }
}
