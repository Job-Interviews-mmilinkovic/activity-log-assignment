<?php

declare(strict_types=1);

namespace App\Events;

use App\Enums\Action;

abstract class Event
{
    abstract public function getAction(): Action;
}
