<?php

declare(strict_types=1);

namespace App\Context\Booking\Application\Bus;

use App\Context\Shared\Application\Bus\Query\Response;

final class FindUsersByCheckInHotelQueryResponse implements Response
{
    public const ID = 'id';
    public const NAME = 'name';
    private $result;

    public function __construct(array $result)
    {
        $this->result = $result;
    }

    public function result(): array
    {
        return $this->result;
    }

    public function name(): string
    {
        return $this->result[self::NAME];
    }
}
