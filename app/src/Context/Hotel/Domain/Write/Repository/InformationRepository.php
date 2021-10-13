<?php

declare(strict_types=1);

namespace App\Context\Hotel\Domain\Write\Repository;

use App\Context\Hotel\Domain\Write\Aggregate\Information;

interface InformationRepository
{
    public function save(Information $information);
}
