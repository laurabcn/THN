<?php

declare(strict_types=1);

namespace App\Context\Booking\Application\Bus\Query;

use App\Context\Booking\Application\Bus\FindBookingsByCheckInHotelQuery;
use App\Context\Booking\Application\Bus\FindBookingsByCheckInHotelQueryResponse;
use App\Context\Booking\Application\Bus\FindBookingsByCheckInHotelQueryResponseConverter;
use App\Context\Booking\Domain\Read\Repository\BookingRepository;
use App\Context\Shared\Application\Bus\Query\QueryHandlerInterface;

final class FindBookingsByCheckInQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private BookingRepository $bookingRepository,
        private FindBookingsByCheckInHotelQueryResponseConverter $converter
    ) {
    }

    public function __invoke(FindBookingsByCheckInHotelQuery $query): FindBookingsByCheckInHotelQueryResponse
    {
        $views = $this->bookingRepository->findByCheckIn();

        if(null === $views) {
            return new FindBookingsByCheckInHotelQueryResponse([]);
        }

        return $this->converter->__invoke($views);
    }
}
