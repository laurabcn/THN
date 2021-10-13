<?php

namespace App\Context\Hotel\Domain\Write\Aggregate;

class Information
{
    public function __construct(
        private string $id,
        private string $name,
        private int $numTotalRooms,
        private int $rating,
        private bool $wifi,
        private bool $pool,
        private bool $parking,
        private bool $petsAllowed,
        private bool $bar,
        private bool $cityView,
        private bool $smooking,
        private string $description
    )
    {
    }

}