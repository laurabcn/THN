<?php

declare(strict_types=1);

namespace App\Context\Booking\Domain\Write\Repository;

use App\Context\Booking\Domain\Write\Aggregate\User;

interface UserRepository
{
    public function save(User $user);
}
