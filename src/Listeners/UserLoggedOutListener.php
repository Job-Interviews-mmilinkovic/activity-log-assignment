<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Enums\Action;
use App\Events\UserLoggedOutEvent;
use App\Services\ActivityLogService;

class UserLoggedOutListener
{
    public function __construct(
        private readonly ActivityLogService $service = new ActivityLogService(),
    ) {
    }

    public function handle(UserLoggedOutEvent $event): void
    {
        $this->service
            ->setAction(Action::Logout)
            ->log($event->userId);
    }
}
