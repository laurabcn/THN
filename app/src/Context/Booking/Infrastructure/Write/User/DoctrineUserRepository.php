<?php

declare(strict_types=1);

namespace App\Context\Booking\Infrastructure\Write\User;

use App\Context\Booking\Domain\Write\Aggregate\User;
use App\Context\Booking\Domain\Write\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineUserRepository implements UserRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    public function save(User $user)
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
