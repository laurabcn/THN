<?php

declare(strict_types=1);

namespace App\Context\Hotel\Domain\Read\Repository;

use App\Context\Hotel\Domain\Read\View\InformationView;

interface InformationRepository
{
    public function findById(string $id): ?InformationView;
}
