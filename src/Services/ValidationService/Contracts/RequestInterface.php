<?php

declare(strict_types=1);

namespace App\Services\ValidationService\Contracts;

interface RequestInterface
{
    public function validate(): bool;

    public function getErrors(): array;

    public function getData(): array;
}
