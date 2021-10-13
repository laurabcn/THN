<?php

declare(strict_types=1);

namespace App\Context\Hotel\Application\Bus;

use App\Context\Shared\Application\Bus\Query\Response;

final class FindInformationByIdHotelQueryResponse implements Response
{
    public const ID = 'id';
    public const NAME = 'name';
    public const NUM_TOTAL_ROOMS = 'num_total_rooms';
    public const RATING = 'rating';
    public const WIFI = 'wifi';
    public const POOL = 'pool';
    public const PARKING = 'parking';
    public const PETS_ALLOWED = 'pets_allowed';
    public const BAR = 'bar';
    public const CITY_VIEW = 'city_view';
    public const SMOOKING = 'smooking';
    public const DESCRIPTION = 'description';
    private $result;

    public function __construct(array $result)
    {
        $this->result = $result;
    }

    public function result(): array
    {
        return $this->result;
    }

    public function id(): string
    {
        return $this->result[self::ID];
    }

    public function name(): string
    {
        return $this->result[self::NAME];
    }

    public function numTotalRooms(): string
    {
        return $this->result[self::NUM_TOTAL_ROOMS];
    }

    public function rating(): string
    {
        return $this->result[self::RATING];
    }

    public function wifi(): string
    {
        return $this->result[self::WIFI];
    }

    public function pool(): string
    {
        return $this->result[self::POOL];
    }
    public function parking(): string
    {
        return $this->result[self::PARKING];
    }

    public function petsAllowed(): string
    {
        return $this->result[self::PETS_ALLOWED];
    }

    public function bar(): string
    {
        return $this->result[self::BAR];
    }

    public function cityView(): string
    {
        return $this->result[self::CITY_VIEW];
    }

    public function smooking(): string
    {
        return $this->result[self::SMOOKING];
    }

    public function description(): string
    {
        return $this->result[self::DESCRIPTION];
    }
}
