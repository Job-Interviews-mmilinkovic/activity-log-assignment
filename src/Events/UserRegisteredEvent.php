<?php

declare(strict_types=1);

namespace App\Events;

use App\Enums\Action;

class UserRegisteredEvent extends Event
{
    public function __construct(
        public readonly int $userId,
    ) {
    }

    public function getAction(): Action
    {
        return Action::Register;
    }
}
