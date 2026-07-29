<?php

declare(strict_types=1);

namespace App\Services\ValidationService\DTO;

class RegisterDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    ) {
    }

    public function getData(): array
    {
        return [
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => $this->password,
        ];
    }
}
