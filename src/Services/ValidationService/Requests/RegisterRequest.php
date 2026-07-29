<?php

declare(strict_types=1);

namespace App\Services\ValidationService\Requests;

use App\Services\ValidationService\Contracts\RequestInterface;

class RegisterRequest implements RequestInterface
{
    private array $errors = [];

    public function __construct(private readonly array $data)
    {
    }

    public function validate(): bool
    {
        $this->errors = [];

        $name = $this->data['name'] ?? '';
        $email = $this->data['email'] ?? '';
        $password = $this->data['password'] ?? '';
        $repeat = $this->data['password_repeat'] ?? '';

        if (trim($name) === '') {
            $this->errors['name'] = 'Name is required.';
        }

        if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
            $this->errors['email'] = 'Invalid email format.';
        }

        if (strlen($password) < 3) {
            $this->errors['password'] = 'Password must be at least 3 characters.';
        }

        if ($password !== $repeat) {
            $this->errors['password_repeat'] = 'Passwords do not match.';
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
