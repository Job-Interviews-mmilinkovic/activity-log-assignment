<?php

declare(strict_types=1);

namespace App\Events;

use App\Bootstrap\Container;

class EventDispatcher
{
    private static ?EventDispatcher $globalInstance = null;

    private array $listeners = [];

    public function __construct(
        private readonly Container $container,
    ) {
    }

    public static function setInstance(EventDispatcher $dispatcher): void
    {
        self::$globalInstance = $dispatcher;
    }

    public static function instance(): ?self
    {
        return self::$globalInstance;
    }

    public function listen(string $eventClass, string $listenerClass): void
    {
        $this->listeners[$eventClass][] = $listenerClass;
    }

    public function dispatch(Event $event): void
    {
        foreach ($this->listeners[$event::class] ?? [] as $listenerClass) {
            $listener = $this->container->get($listenerClass);
            $listener->handle($event);
        }
    }
}
