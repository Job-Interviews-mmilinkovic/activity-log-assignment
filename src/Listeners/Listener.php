<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\Event;

interface Listener
{
    public function handle(Event $event): void;
}
