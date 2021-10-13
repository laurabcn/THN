<?php

declare(strict_types=1);

namespace App\Context\Hotel\UI\Controller;

use App\Context\Hotel\Application\Bus\FindInformationByIdHotelQuery;
use App\Context\Shared\Application\Bus\Query\QueryBusInterface;
use App\Context\Shared\UI\Response\ApiHttpResponse;
use App\Context\Shared\UI\Response\HttpResponseCode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;


final class GetInformationController extends AbstractController
{
    public function __construct(
        private QueryBusInterface $queryBus
    )
    {
    }

    public function __invoke(Request $request): ApiHttpResponse
    {
        $routeParams = $request->attributes->get('_route_params');

        $query = FindInformationByIdHotelQuery::create($routeParams['hotel_id']);

        $queryResponse = $this->queryBus->ask($query);


        if(empty($queryResponse->result())) {
            return new ApiHttpResponse($queryResponse->result(), HttpResponseCode::HTTP_NO_CONTENT);
        }

        return new ApiHttpResponse($queryResponse->result());
    }
}
