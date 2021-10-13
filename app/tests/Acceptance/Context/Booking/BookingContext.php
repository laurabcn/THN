<?php

namespace App\Tests\Acceptance\Context\Booking;

use App\Context\Booking\Domain\Write\Repository\BookingRepository;
use App\Context\Booking\Domain\Write\Aggregate\Room;
use Behat\Behat\Context\Context;

final class BookingContext implements Context
{

    public function __construct(
        private BookingRepository $bookingRepository
    )
    {
    }

    /**
     * @Given A room with id :id
     */
    public function aRoomWithId($id)
    {
        $room = new Room(
            $id,
            '20',
            'habita encantadora',
            '4aee60a9-662a-4b3f-bcc8-2b20070d00aa',
            2,
            3,
            new \DateTimeImmutable('2021-10-01'),
            new \DateTimeImmutable('2021-12-01')
        );

        $this->bookingRepository->save($room);
    }
}
