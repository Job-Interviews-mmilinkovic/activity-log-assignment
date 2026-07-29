<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Bootstrap\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $this->table('users')->insert([
            'name'  => 'Admin',
            'email' => 'admin@example.com',
        ]);
    }
}
