<?php

declare(strict_types=1);

namespace App\Context\Hotel\Application\Bus;

use App\Context\Shared\Application\Bus\Query\Query;

final class FindInformationByIdHotelQuery extends Query
{
    private const ID = 'id';

    public static function create(string $id): self
    {
        return new self([
            self::ID => $id
        ]);
    }

    public function id(): string
    {
        return $this->get(self::ID);
    }

    protected static function stringMessageName(): string
    {
        return 'thn.query.hotel.find_information_by_id_hotel';
    }
}
