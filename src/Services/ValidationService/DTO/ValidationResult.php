<?php

declare(strict_types=1);

namespace App\Services\ValidationService\DTO;

class ValidationResult
{
    public function __construct(
        private readonly bool $valid,
        private readonly array $errors,
        private readonly mixed $data = null,
    ) {
    }

    public function isValid(): bool
    {
        return $this->valid;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getFirstError(): string
    {
        $first = $this->errors[array_key_first($this->errors)] ?? null;
        return $first ?? 'Validation failed.';
    }

    public function getData(): array
    {
        return $this->data?->getData() ?? [];
    }
}
