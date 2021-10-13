<?php

declare(strict_types=1);

namespace App\Context\Booking\Application\Bus\Query;

use App\Context\Booking\Application\Bus\FindBookingsByCheckInHotelQuery;
use App\Context\Booking\Application\Bus\FindBookingsByCheckInHotelQueryResponse;
use App\Context\Booking\Application\Bus\FindBookingsByCheckInHotelQueryResponseConverter;
use App\Context\Booking\Application\Bus\FindUsersByCheckInHotelQuery;
use App\Context\Booking\Application\Bus\FindUsersByCheckInHotelQueryResponse;
use App\Context\Booking\Application\Bus\FindUsersByCheckInHotelQueryResponseConverter;
use App\Context\Booking\Domain\Read\Repository\BookingRepository;
use App\Context\Booking\Domain\Read\Repository\UserRepository;
use App\Context\Hotel\Application\Bus\FindInformationByIdHotelQueryResponse;
use App\Context\Shared\Application\Bus\Query\QueryHandlerInterface;

final class FindUsersByCheckInQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private UserRepository $userRepository,
        private FindUsersByCheckInHotelQueryResponseConverter $converter
    ) {
    }

    public function __invoke(FindUsersByCheckInHotelQuery $query): FindUsersByCheckInHotelQueryResponse
    {
        $views = $this->userRepository->findByCheckIn();

        if(null === $views) {
            return new FindUsersByCheckInHotelQueryResponse([]);
        }

        return $this->converter->__invoke($views);
    }
}
