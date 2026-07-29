<?php

declare(strict_types=1);

namespace App\Events;

use App\Enums\Action;

class DownloadPageVisitedEvent extends Event
{
    public function __construct(
        public readonly int $userId,
    ) {
    }

    public function getAction(): Action
    {
        return Action::DownloadPageVisited;
    }
}
