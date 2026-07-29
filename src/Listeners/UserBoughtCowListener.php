<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Enums\Action;
use App\Events\UserBoughtCowEvent;
use App\Services\ActivityLogService;

class UserBoughtCowListener
{
    public function __construct(
        private readonly ActivityLogService $service = new ActivityLogService(),
    ) {
    }

    public function handle(UserBoughtCowEvent $event): void
    {
        $this->service
            ->setAction(Action::BuyCow)
            ->log($event->userId);
    }
}
