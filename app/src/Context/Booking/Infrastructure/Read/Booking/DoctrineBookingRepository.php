<?php

declare(strict_types=1);

namespace App\Context\Booking\Infrastructure\Read\Booking;

use App\Context\Booking\Application\Bus\FindBookingsByCheckInHotelQueryResponse;
use App\Context\Booking\Domain\Read\Repository\BookingRepository;
use App\Context\Booking\Domain\Read\View\BookingView;
use Doctrine\DBAL\Connection;

final class DoctrineBookingRepository implements BookingRepository
{
    public function __construct(
        private Connection $connection
    )
    {
    }

    public function findByCheckIn(): ?BookingView
    {
        $bookings = $this->connection->fetchAll('select * from rooms where checkIn <= NOW() and checkOut >= NOW()');

        if(empty($bookings)) {
            return null;
        }

        foreach ($bookings as $booking) {
            $response[] =
                [
                    FindBookingsByCheckInHotelQueryResponse::NAME => $booking[ FindBookingsByCheckInHotelQueryResponse::NAME ],
                    FindBookingsByCheckInHotelQueryResponse::CAPACITY => $booking[ FindBookingsByCheckInHotelQueryResponse::CAPACITY ],
                    FindBookingsByCheckInHotelQueryResponse::BEDS_TWIN => $booking[ FindBookingsByCheckInHotelQueryResponse::BEDS_TWIN ],
                    FindBookingsByCheckInHotelQueryResponse::FULL_BED => $booking[ FindBookingsByCheckInHotelQueryResponse::FULL_BED ],
                    FindBookingsByCheckInHotelQueryResponse::CHECK_IN => $booking[ FindBookingsByCheckInHotelQueryResponse::CHECK_IN ],
                    FindBookingsByCheckInHotelQueryResponse::CHECK_OUT => $booking[ FindBookingsByCheckInHotelQueryResponse::CHECK_OUT ]
                ];
        }
        return BookingView::build($response);
    }
}
