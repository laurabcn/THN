<?php

namespace App\Context\Booking\Domain\Write\Aggregate;

class Room
{
    public function __construct(
        private string $id,
        private int $capacity,
        private string $name,
        private string $userId,
        private int $bedsTwin,
        private int $fullBeds,
        private \DateTimeImmutable $checkIn,
        private \DateTimeImmutable $checkOut
    )
    {
    }

}