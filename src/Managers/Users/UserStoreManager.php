<?php

declare(strict_types=1);

namespace App\Managers\Users;

use App\Managers\Users\DTO\StoreUserDTO;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Capsule\Manager as Capsule;
use Throwable;

class UserStoreManager
{
    public function store(StoreUserDTO $dto): User
    {
        try {
            $role = Role::where('name', 'user')->firstOrFail();

            return Capsule::connection()->transaction(function () use ($dto, $role) {
                return User::create([
                    'email'    => $dto->email,
                    'password' => password_hash($dto->password, PASSWORD_BCRYPT, ['cost' => 10]),
                    'name'     => $dto->name,
                    'role_id'  => $role->id,
                    'isactive' => (int) $dto->isActive,
                ]);
            });
        } catch (Throwable $e) {
            throw new UserStoreException(
                'Failed to create user: ' . $e->getMessage(),
                previous: $e,
            );
        }
    }
}
