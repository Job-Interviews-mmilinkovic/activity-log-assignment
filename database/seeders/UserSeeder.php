<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Bootstrap\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminHash = password_hash('super.admin', PASSWORD_BCRYPT, ['cost' => 10]);
        $userHash = password_hash('pera1234', PASSWORD_BCRYPT, ['cost' => 10]);

        $this->table('users')->insert([
            'email'    => 'super.admin@yopmail.com',
            'password' => $adminHash,
            'name'     => 'Super Admin',
            'role_id'  => 1,
            'isactive' => 1,
        ]);

        $this->table('users')->insert([
            'email'    => 'pera@yopmail.com',
            'password' => $userHash,
            'name'     => 'Pera',
            'role_id'  => 2,
            'isactive' => 1,
        ]);
    }
}
