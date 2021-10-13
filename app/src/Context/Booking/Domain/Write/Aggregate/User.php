<?php

namespace App\Context\Booking\Domain\Write\Aggregate;

class User
{
    public function __construct(
        private string $id,
        private string $userId,
        private string $roomId,
        private string $name
    )
    {
    }

}