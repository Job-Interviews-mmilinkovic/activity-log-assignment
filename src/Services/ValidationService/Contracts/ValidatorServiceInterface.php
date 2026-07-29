<?php

declare(strict_types=1);

namespace App\Services\ValidationService\Contracts;

use App\Services\ValidationService\DTO\ValidationResult;

interface ValidatorServiceInterface
{
    public function validateRegister(array $data): ValidationResult;

    public function validateLogin(array $data): ValidationResult;
}
