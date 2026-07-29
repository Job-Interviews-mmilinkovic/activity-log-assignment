<?php

declare(strict_types=1);

namespace App\Services\ValidationService\Requests;

use App\Services\ValidationService\Contracts\RequestInterface;

class LoginRequest implements RequestInterface
{
    private array $errors = [];

    public function __construct(private readonly array $data)
    {
    }

    public function validate(): bool
    {
        $this->errors = [];

        $email = $this->data['email'] ?? '';
        $password = $this->data['password'] ?? '';

        if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
            $this->errors['email'] = 'Invalid email format.';
        }

        if (trim($password) === '') {
            $this->errors['password'] = 'Password is required.';
        }

        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
