<?php

declare(strict_types=1);

namespace App\Context\Booking\Application\Bus;

use App\Context\Booking\Domain\Read\View\BookingView;

final class FindBookingsByCheckInHotelQueryResponseConverter
{
    public function __invoke(BookingView $views): FindBookingsByCheckInHotelQueryResponse
    {

        foreach ($views->rooms() as $view) {
            $response[] =
                [
                    FindBookingsByCheckInHotelQueryResponse::NAME => $view[FindBookingsByCheckInHotelQueryResponse::NAME],
                    FindBookingsByCheckInHotelQueryResponse::CAPACITY => $view[FindBookingsByCheckInHotelQueryResponse::CAPACITY],
                    FindBookingsByCheckInHotelQueryResponse::BEDS_TWIN => $view[FindBookingsByCheckInHotelQueryResponse::BEDS_TWIN],
                    FindBookingsByCheckInHotelQueryResponse::FULL_BED => $view[FindBookingsByCheckInHotelQueryResponse::FULL_BED],
                    FindBookingsByCheckInHotelQueryResponse::CHECK_IN => $view[FindBookingsByCheckInHotelQueryResponse::CHECK_IN],
                    FindBookingsByCheckInHotelQueryResponse::CHECK_OUT => $view[FindBookingsByCheckInHotelQueryResponse::CHECK_OUT],
                ];
        }

        return new FindBookingsByCheckInHotelQueryResponse($response);
    }
}
