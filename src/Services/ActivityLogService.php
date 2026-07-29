<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Action;
use App\Models\ActivityLog;

class ActivityLogService
{
    private ?Action $action = null;

    public function setAction(Action $action): static
    {
        $this->action = $action;
        return $this;
    }

    public function log(int $userId): void
    {
        ActivityLog::create([
            'user_id' => $userId,
            'action'  => $this->action->value,
        ]);
    }
}
