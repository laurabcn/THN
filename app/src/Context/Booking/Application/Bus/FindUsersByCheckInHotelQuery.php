<?php

declare(strict_types=1);

namespace App\Context\Booking\Application\Bus;

use App\Context\Shared\Application\Bus\Query\Query;

final class FindUsersByCheckInHotelQuery extends Query
{
    public static function create(): self
    {
        return new self([]);
    }

    protected static function stringMessageName(): string
    {
        return 'thn.query.booking.find_users_by_check_in';
    }
}
