<?php

declare(strict_types=1);

namespace App\Services\ValidationService;

use App\Services\ValidationService\Contracts\ValidatorServiceInterface;
use App\Services\ValidationService\DTO\LoginDTO;
use App\Services\ValidationService\DTO\RegisterDTO;
use App\Services\ValidationService\DTO\ValidationResult;
use App\Services\ValidationService\Requests\LoginRequest;
use App\Services\ValidationService\Requests\RegisterRequest;

class ValidatorService implements ValidatorServiceInterface
{
    public function validateRegister(array $data): ValidationResult
    {
        $request = new RegisterRequest($data);

        if (!$request->validate()) {
            return new ValidationResult(false, $request->getErrors());
        }

        return new ValidationResult(true, [], new RegisterDTO(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],
        ));
    }

    public function validateLogin(array $data): ValidationResult
    {
        $request = new LoginRequest($data);

        if (!$request->validate()) {
            return new ValidationResult(false, $request->getErrors());
        }

        return new ValidationResult(true, [], new LoginDTO(
            email: $data['email'],
            password: $data['password'],
        ));
    }
}
