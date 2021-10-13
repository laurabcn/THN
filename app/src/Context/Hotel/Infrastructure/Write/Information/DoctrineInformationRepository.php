<?php

declare(strict_types=1);

namespace App\Context\Hotel\Infrastructure\Write\Information;

use App\Context\Hotel\Domain\Write\Aggregate\HotelId;
use App\Context\Hotel\Domain\Write\Aggregate\Information;
use App\Context\Hotel\Domain\Write\Repository\InformationRepository;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineInformationRepository implements InformationRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    public function save(Information $information)
    {
        $this->entityManager->persist($information);
        $this->entityManager->flush();
    }

    public function find(HotelId $hotelId): ?Information
    {
        return $this->entityManager->getRepository(Information::class)->find($hotelId);
    }
}
