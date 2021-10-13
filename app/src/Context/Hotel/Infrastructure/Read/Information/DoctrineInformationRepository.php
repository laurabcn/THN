<?php

declare(strict_types=1);

namespace App\Context\Hotel\Infrastructure\Read\Information;

use App\Context\Hotel\Domain\Read\Repository\InformationRepository;
use App\Context\Hotel\Domain\Read\View\InformationView;
use Doctrine\DBAL\Connection;

final class DoctrineInformationRepository implements InformationRepository
{
    public function __construct(
        private Connection $connection
    )
    {
    }

    public function findById(string $id): ?InformationView
    {
        $information = $this->connection->fetchAll('select * from information where id= "' . $id .'"');

        if(empty($information)) {
            return null;
        }

        return InformationView::buildInformationView(
            $information[0]['name'],
            (int) $information[0]['numTotalRooms'],
            (int) $information[0]['rating'],
            (bool) $information[0]['wifi'],
            (bool) $information[0]['pool'],
            (bool) $information[0]['parking'],
            (bool) $information[0]['petsAllowed'],
            (bool) $information[0]['bar'],
            (bool) $information[0]['cityView'],
            (bool) $information[0]['smooking'],
            $information[0]['description'],
        );
    }
}
