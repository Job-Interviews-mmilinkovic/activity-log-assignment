<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Enums\Action;
use App\Events\CowPageVisitedEvent;
use App\Services\ActivityLogService;

class CowPageVisitedListener
{
    public function __construct(
        private readonly ActivityLogService $service = new ActivityLogService(),
    ) {
    }

    public function handle(CowPageVisitedEvent $event): void
    {
        $this->service
            ->setAction(Action::CowPageVisited)
            ->log($event->userId);
    }
}
