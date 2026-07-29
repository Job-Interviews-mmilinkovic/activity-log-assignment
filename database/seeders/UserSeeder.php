<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Bootstrap\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $hash = password_hash('super.admin', PASSWORD_BCRYPT, ['cost' => 10]);

        $this->table('users')->insert([
            'email'    => 'super.admin@yopmail.com',
            'password' => $hash,
            'name'     => 'Super Admin',
            'role_id'  => 1,
            'isactive' => 1,
        ]);
    }
}
