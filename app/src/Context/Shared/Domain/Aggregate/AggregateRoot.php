<?php

declare(strict_types=1);

namespace App\Context\Shared\Domain\Aggregate;

use App\Context\Shared\Application\Bus\Event\Event;
use App\Context\Shared\Domain\ValueObject\Uuid;

abstract class AggregateRoot
{
    /** @var array|Event[] */
    private iterable $events = [];

    abstract public function id(): Uuid;

    public function recordThat(Event $event): void
    {
        $this->events[] = $event;
    }

    /** @return Event[] */
    public function uncommittedEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

    /** @return Event[] */
    public function events(): array
    {
        return $this->events;
    }
}