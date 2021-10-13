<?php

declare(strict_types=1);

namespace App\Context\Booking\Infrastructure\Read\Users;

use App\Context\Booking\Application\Bus\FindUsersByCheckInHotelQueryResponse;
use App\Context\Booking\Domain\Read\Repository\UserRepository;
use App\Context\Booking\Domain\Read\View\UserView;
use Doctrine\DBAL\Connection;

final class DoctrineUsersRepository implements UserRepository
{
    public function __construct(
        private Connection $connection
    )
    {
    }

    public function findByCheckIn(): ?UserView
    {
        $names = $this->connection->fetchAll('select u.name 
from rooms r
LEFT JOIN userRoom u ON r.id = u.roomId
where r.checkIn <= NOW() and r.checkOut >= NOW();');

        if(empty($names)) {
            return null;
        }

        foreach ($names as $name) {
            $response[] = $name[ FindUsersByCheckInHotelQueryResponse::NAME ];
        }

        return UserView::build($response);
    }
}
