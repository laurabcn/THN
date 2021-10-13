<?php

declare(strict_types=1);

namespace App\Context\Hotel\Domain\Read\View;

class InformationView
{
    private function __construct(
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
    ) {
    }

    public static function buildInformationView(
        string $name,
        int $numTotalRooms,
        int $rating,
        bool $wifi,
        bool $pool,
        bool $parking,
        bool $petsAllowed,
        bool $bar,
        bool $cityView,
        bool $smooking,
        string $description
    ): InformationView{
        return new self($name, $numTotalRooms, $rating, $wifi, $pool, $parking, $petsAllowed, $bar, $cityView, $smooking, $description);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function numTotalRooms(): int
    {
        return $this->numTotalRooms;
    }

    public function rating(): int
    {
        return $this->rating;
    }

    public function hasWifi(): bool
    {
        return $this->wifi;
    }

    public function hasPool(): bool
    {
        return $this->pool;
    }

    public function hasParking(): bool
    {
        return $this->parking;
    }

    public function hasPetsAllowed(): bool
    {
        return $this->petsAllowed;
    }

    public function hasBar(): bool
    {
        return $this->bar;
    }

    public function hasCityView(): bool
    {
        return $this->cityView;
    }

    public function isSmooking(): bool
    {
        return $this->smooking;
    }

    public function description(): string
    {
        return $this->description;
    }
}
