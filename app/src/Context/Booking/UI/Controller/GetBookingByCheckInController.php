<?php

declare(strict_types=1);

namespace App\Context\Booking\UI\Controller;

use App\Context\Booking\Application\Bus\FindBookingsByCheckInHotelQuery;
use App\Context\Shared\Application\Bus\Query\QueryBusInterface;
use App\Context\Shared\UI\Response\ApiHttpResponse;
use App\Context\Shared\UI\Response\HttpResponseCode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


final class GetBookingByCheckInController extends AbstractController
{
    public function __construct(
        private QueryBusInterface $queryBus
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $query = FindBookingsByCheckInHotelQuery::create();

        $queryResponse = $this->queryBus->ask($query);

        if(empty($queryResponse->result())) {
            return new ApiHttpResponse($queryResponse->result(), HttpResponseCode::HTTP_NO_CONTENT);
        }

        return new JsonResponse($queryResponse->result());
    }
}
