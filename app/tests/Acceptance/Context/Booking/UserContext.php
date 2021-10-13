<?php

namespace App\Tests\Acceptance\Context\Booking;

use App\Context\Booking\Domain\Write\Aggregate\Room;
use App\Context\Booking\Domain\Write\Aggregate\User;
use App\Context\Booking\Domain\Write\Repository\BookingRepository;
use App\Context\Booking\Domain\Write\Repository\UserRepository;
use Behat\Behat\Context\Context;

final class UserContext implements Context
{

    public function __construct(
        private UserRepository $userRepository,
        private BookingRepository $bookingRepository
    )
    {
    }

    /**
     * @Given A user with id :id
     */
    public function aUserWithId($id)
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
        $user = new User(
            $id,
            '4aee60a9-662a-4b3f-bcc8-2b20070d00aa',
            '3d7fd4ad-3be8-496e-9981-1e08a18ea0be',
            'habita con encanto y tal'
        );

        $this->userRepository->save($user);
    }
}
