<?php

namespace App\Tests\Unit\Context\Hotel\Application\Bus\Query;

use App\Context\Hotel\Application\Bus\FindInformationByIdHotelQuery;
use App\Context\Hotel\Application\Bus\FindInformationByIdHotelQueryResponse;
use App\Context\Hotel\Application\Bus\FindInformationByIdHotelQueryResponseConverter;
use App\Context\Hotel\Application\Bus\Query\FindInformationByIdHotelQueryHandler;
use App\Context\Hotel\Domain\Read\Repository\InformationRepository;
use App\Context\Hotel\Domain\Read\View\InformationView;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FindInformationByIdHotelQueryHandlerTest extends TestCase
{
    private InformationRepository | MockObject $informationRepository;
    private FindInformationByIdHotelQueryHandler $queryHandler;
    private FindInformationByIdHotelQueryResponse $response;
    private InformationView $view;
    private FindInformationByIdHotelQueryResponseConverter $responseConverter;
    private Generator $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create();
        $this->view = InformationView::buildInformationView(
            $this->faker->name(),
            $this->faker->numberBetween(1,10),
            $this->faker->numberBetween(1,5),
            $this->faker->boolean(),
            $this->faker->boolean(),
            $this->faker->boolean(),
            $this->faker->boolean(),
            $this->faker->boolean(),
            $this->faker->boolean(),
            $this->faker->boolean(),
            $this->faker->text()
        );
        $this->informationRepository = $this->createMock(InformationRepository::class);
        $this->responseConverter = new FindInformationByIdHotelQueryResponseConverter();
        $this->queryHandler = new FindInformationByIdHotelQueryHandler($this->informationRepository, $this->responseConverter);
    }

    public function test_it_returns_the_expected_query_response_when_hotel_has_information(): void
    {
        $this->givenHotelExists();
        $this->whenHandlingQuery();
        $this->thenResponseAsIsExpected(
            new FindInformationByIdHotelQueryResponse(
                [
                    FindInformationByIdHotelQueryResponse::NAME => $this->view->name(),
                    FindInformationByIdHotelQueryResponse::NUM_TOTAL_ROOMS => $this->view->numTotalRooms(),
                    FindInformationByIdHotelQueryResponse::RATING => $this->view->rating(),
                    FindInformationByIdHotelQueryResponse::WIFI => $this->view->hasWifi(),
                    FindInformationByIdHotelQueryResponse::POOL => $this->view->hasPool(),
                    FindInformationByIdHotelQueryResponse::PARKING => $this->view->hasParking(),
                    FindInformationByIdHotelQueryResponse::PETS_ALLOWED => $this->view->hasPetsAllowed(),
                    FindInformationByIdHotelQueryResponse::BAR => $this->view->hasBar(),
                    FindInformationByIdHotelQueryResponse::CITY_VIEW => $this->view->hasCityView(),
                    FindInformationByIdHotelQueryResponse::SMOOKING => $this->view->isSmooking(),
                    FindInformationByIdHotelQueryResponse::DESCRIPTION => $this->view->description(),
                ]
            )
        );
    }

    public function test_it_no_returns_information_query_response_when_hotel_has_not_information(): void
    {
        $this->givenHotelNonExists();
        $this->whenHandlingQuery();
        $this->thenResponseAsIsExpected(new FindInformationByIdHotelQueryResponse([]));
    }

    private function givenHotelExists(): void
    {
        $this->informationRepository->method('findById')->willReturn($this->view);
    }

    private function givenHotelNonExists(): void
    {
        $this->informationRepository->method('findById')->willReturn(null);
    }

    private function whenHandlingQuery(): void
    {

        $this->response = $this->queryHandler->__invoke(
            FindInformationByIdHotelQuery::create(
                $this->faker->uuid()
            )
        );
    }

    private function thenResponseAsIsExpected(FindInformationByIdHotelQueryResponse $expectedResponse): void
    {
        $this->assertEquals($expectedResponse, $this->response);
    }

    private function thenResponseAsIsNotExpected(FindInformationByIdHotelQueryResponse $expectedResponse): void
    {
        $this->assertEquals($expectedResponse, $this->response);
    }


}
