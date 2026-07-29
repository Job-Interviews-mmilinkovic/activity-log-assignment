<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Enums\Action;
use App\Events\DownloadPageVisitedEvent;
use App\Services\ActivityLogService;

class DownloadPageVisitedListener
{
    public function __construct(
        private readonly ActivityLogService $service = new ActivityLogService(),
    ) {
    }

    public function handle(DownloadPageVisitedEvent $event): void
    {
        $this->service
            ->setAction(Action::DownloadPageVisited)
            ->log($event->userId);
    }
}
