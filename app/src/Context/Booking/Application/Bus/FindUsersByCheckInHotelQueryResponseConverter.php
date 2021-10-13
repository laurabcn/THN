<?php

declare(strict_types=1);

namespace App\Context\Booking\Application\Bus;

use App\Context\Booking\Domain\Read\View\UserView;

final class FindUsersByCheckInHotelQueryResponseConverter
{
    public function __invoke(UserView $views): FindUsersByCheckInHotelQueryResponse
    {
        foreach ($views->users() as $view) {
            $response[] = $view;
        }
 
        return new FindUsersByCheckInHotelQueryResponse($response);
    }
}
