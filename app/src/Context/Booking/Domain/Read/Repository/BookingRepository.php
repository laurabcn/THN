<?php

declare(strict_types=1);

namespace App\Context\Booking\Domain\Read\Repository;

use App\Context\Booking\Domain\Read\View\BookingView;

interface BookingRepository
{
    public function findByCheckIn(): ?BookingView;
}
