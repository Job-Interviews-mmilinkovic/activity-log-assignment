<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Enums\Action;
use App\Events\UserLoggedInEvent;
use App\Services\ActivityLogService;

class UserLoggedInListener
{
    public function __construct(
        private readonly ActivityLogService $service = new ActivityLogService(),
    ) {
    }

    public function handle(UserLoggedInEvent $event): void
    {
        $this->service
            ->setAction(Action::Login)
            ->log($event->userId);
    }
}
