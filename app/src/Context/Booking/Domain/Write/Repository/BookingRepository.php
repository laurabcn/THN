<?php

declare(strict_types=1);

namespace App\Context\Booking\Domain\Write\Repository;

use App\Context\Booking\Domain\Write\Aggregate\Room;

interface BookingRepository
{
    public function save(Room $room);
}
