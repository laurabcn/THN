<?php

namespace App\Context\Hotel\Domain\Write\Aggregate;

final class HotelId
{
    private function __construct(
        private string $value
    )
    {
    }
}