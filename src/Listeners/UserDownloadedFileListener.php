<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Enums\Action;
use App\Events\UserDownloadedFileEvent;
use App\Services\ActivityLogService;

class UserDownloadedFileListener
{
    public function __construct(
        private readonly ActivityLogService $service = new ActivityLogService(),
    ) {
    }

    public function handle(UserDownloadedFileEvent $event): void
    {
        $this->service
            ->setAction(Action::Download)
            ->log($event->userId);
    }
}
