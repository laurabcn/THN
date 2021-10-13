<?php

declare(strict_types=1);

namespace App\Context\Booking\Application\Bus;

use App\Context\Shared\Application\Bus\Query\Response;

final class FindBookingsByCheckInHotelQueryResponse implements Response
{
    public const ID = 'id';
    public const NAME = 'name';
    public const CAPACITY = 'capacity';
    public const BEDS_TWIN = 'bedsTwin';
    public const FULL_BED = 'fullBeds';
    public const CHECK_IN = 'checkIn';
    public const CHECK_OUT = 'checkOut';
    public const ROOMS = 'rooms';
    private $result;

    public function __construct(array $result)
    {
        $this->result = $result;
    }

    public function result(): array
    {
        return $this->result;
    }

    public function rooms(): array
    {
        return $this->result[self::ROOMS];
    }

    public function name(): string
    {
        return $this->result[self::ROOMS][self::NAME];
    }

    public function capacity(): string
    {
        return $this->result[self::ROOMS][self::CAPACITY];
    }

    public function bedsTwin(): string
    {
        return $this->result[self::ROOMS][self::BEDS_TWIN];
    }

    public function fullBed(): string
    {
        return $this->result[self::ROOMS][self::FULL_BED];
    }

    public function checkIn(): string
    {
        return $this->result[self::ROOMS][self::CHECK_IN];
    }
    public function checkOut(): string
    {
        return $this->result[self::ROOMS][self::CHECK_OUT];
    }
}
