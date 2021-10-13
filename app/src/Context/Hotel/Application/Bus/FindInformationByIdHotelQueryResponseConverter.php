<?php

declare(strict_types=1);

namespace App\Context\Hotel\Application\Bus;

use App\Context\Hotel\Domain\Read\View\InformationView;

final class FindInformationByIdHotelQueryResponseConverter
{
    public function __invoke(InformationView $view): FindInformationByIdHotelQueryResponse
    {
        return new FindInformationByIdHotelQueryResponse(
            [
                FindInformationByIdHotelQueryResponse::NAME => $view->name(),
                FindInformationByIdHotelQueryResponse::NUM_TOTAL_ROOMS => $view->numTotalRooms(),
                FindInformationByIdHotelQueryResponse::RATING => $view->rating(),
                FindInformationByIdHotelQueryResponse::WIFI => $view->hasWifi(),
                FindInformationByIdHotelQueryResponse::POOL => $view->hasPool(),
                FindInformationByIdHotelQueryResponse::PARKING => $view->hasParking(),
                FindInformationByIdHotelQueryResponse::PETS_ALLOWED => $view->hasPetsAllowed(),
                FindInformationByIdHotelQueryResponse::BAR => $view->hasBar(),
                FindInformationByIdHotelQueryResponse::CITY_VIEW => $view->hasCityView(),
                FindInformationByIdHotelQueryResponse::SMOOKING => $view->isSmooking(),
                FindInformationByIdHotelQueryResponse::DESCRIPTION => $view->description(),
            ]
        );
    }
}
