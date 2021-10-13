<?php

declare(strict_types=1);

namespace App\Context\Booking\Domain\Read\View;

final class BookingView
{
    private function __construct(
        private array $rooms
    )
    {
    }

    public static function build(
        array $rooms
    ): static {
        return new static($rooms);
    }

    public function rooms(): array
    {
        return $this->rooms;
    }
}