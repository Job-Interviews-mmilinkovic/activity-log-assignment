<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Enums\Action;
use App\Events\UserRegisteredEvent;
use App\Services\ActivityLogService;

class UserRegisteredListener
{
    public function __construct(
        private readonly ActivityLogService $service = new ActivityLogService(),
    ) {
    }

    public function handle(UserRegisteredEvent $event): void
    {
        $this->service
            ->setAction(Action::Register)
            ->log($event->userId);
    }
}
