<?php

declare(strict_types=1);

namespace App\Managers\Users\DTO;

readonly class StoreUserDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public bool $isActive = true,
    ) {
    }
}
