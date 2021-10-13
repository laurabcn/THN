<?php

declare(strict_types=1);

namespace App\Context\Booking\Infrastructure\Write\Room;

use App\Context\Booking\Domain\Write\Aggregate\Room;
use App\Context\Booking\Domain\Write\Repository\BookingRepository;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineRoomRepository implements BookingRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    public function save(Room $room)
    {
        $this->entityManager->persist($room);
        $this->entityManager->flush();
    }
}
