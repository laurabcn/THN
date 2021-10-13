<?php

declare(strict_types=1);

namespace App\Context\Hotel\Application\Bus\Query;

use App\Context\Hotel\Application\Bus\FindInformationByIdHotelQuery;
use App\Context\Hotel\Application\Bus\FindInformationByIdHotelQueryResponse;
use App\Context\Hotel\Application\Bus\FindInformationByIdHotelQueryResponseConverter;
use App\Context\Hotel\Domain\Read\Repository\InformationRepository;
use App\Context\Shared\Application\Bus\Query\QueryHandlerInterface;

final class FindInformationByIdHotelQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private InformationRepository $informationRepository,
        private FindInformationByIdHotelQueryResponseConverter $converter
    ) {
    }

    public function __invoke(FindInformationByIdHotelQuery $query): FindInformationByIdHotelQueryResponse
    {
        $view = $this->informationRepository->findById($query->id());

        if(null === $view) {
            return new FindInformationByIdHotelQueryResponse([]);
        }

        return $this->converter->__invoke($view);
    }
}
