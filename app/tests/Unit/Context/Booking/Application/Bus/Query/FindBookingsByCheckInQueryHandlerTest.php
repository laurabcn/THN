<?php

namespace App\Tests\Unit\Context\Booking\Application\Bus\Query;

use App\Context\Booking\Application\Bus\FindBookingsByCheckInHotelQuery;
use App\Context\Booking\Application\Bus\FindBookingsByCheckInHotelQueryResponse;
use App\Context\Booking\Application\Bus\FindBookingsByCheckInHotelQueryResponseConverter;
use App\Context\Booking\Application\Bus\FindUsersByCheckInHotelQuery;
use App\Context\Booking\Application\Bus\FindUsersByCheckInHotelQueryResponse;
use App\Context\Booking\Application\Bus\Query\FindBookingsByCheckInQueryHandler;
use App\Context\Booking\Domain\Read\Repository\BookingRepository;
use App\Context\Booking\Domain\Read\View\BookingView;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FindBookingsByCheckInQueryHandlerTest extends TestCase
{
    private BookingRepository | MockObject $bookingRepository;
    private FindBookingsByCheckInQueryHandler $queryHandler;
    private FindBookingsByCheckInHotelQueryResponse $response;
    private BookingView $view;
    private FindBookingsByCheckInHotelQueryResponseConverter $responseConverter;
    private Generator $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create();
        $this->view = BookingView::build(
            [
                [
                    FindBookingsByCheckInHotelQueryResponse::ID =>$this->faker->uuid(),
                    FindBookingsByCheckInHotelQueryResponse::NAME => $this->faker->name(),
                    FindBookingsByCheckInHotelQueryResponse::CAPACITY => $this->faker->name(),
                    FindBookingsByCheckInHotelQueryResponse::BEDS_TWIN => $this->faker->numberBetween(0,5),
                    FindBookingsByCheckInHotelQueryResponse::FULL_BED => $this->faker->numberBetween(0,5),
                    FindBookingsByCheckInHotelQueryResponse::CHECK_IN => $this->faker->dateTime(),
                    FindBookingsByCheckInHotelQueryResponse::CHECK_OUT => $this->faker->dateTime(),
                ],
                [
                    FindBookingsByCheckInHotelQueryResponse::ID => $this->faker->uuid(),
                    FindBookingsByCheckInHotelQueryResponse::NAME => $this->faker->name(),
                    FindBookingsByCheckInHotelQueryResponse::CAPACITY => $this->faker->name(),
                    FindBookingsByCheckInHotelQueryResponse::BEDS_TWIN => $this->faker->numberBetween(0,5),
                    FindBookingsByCheckInHotelQueryResponse::FULL_BED => $this->faker->numberBetween(0,5),
                    FindBookingsByCheckInHotelQueryResponse::CHECK_IN => $this->faker->dateTime(),
                    FindBookingsByCheckInHotelQueryResponse::CHECK_OUT => $this->faker->dateTime(),
                ]
            ]
        );
        $this->bookingRepository = $this->createMock(BookingRepository::class);
        $this->responseConverter = new FindBookingsByCheckInHotelQueryResponseConverter();
        $this->queryHandler = new FindBookingsByCheckInQueryHandler($this->bookingRepository, $this->responseConverter);
    }

    public function test_it_returns_the_expected_query_response_when_hotel_has_users(): void
    {
        $room1 = $this->view->rooms()[0];
        $room2 = $this->view->rooms()[1];
        $this->givenBookingExists();
        $this->whenHandlingQuery();
        $this->thenResponseAsIsExpected(
            new FindBookingsByCheckInHotelQueryResponse([
                [
                    FindBookingsByCheckInHotelQueryResponse::NAME => $room1[ FindBookingsByCheckInHotelQueryResponse::NAME ],
                    FindBookingsByCheckInHotelQueryResponse::CAPACITY => $room1[ FindBookingsByCheckInHotelQueryResponse::CAPACITY ],
                    FindBookingsByCheckInHotelQueryResponse::BEDS_TWIN => $room1[ FindBookingsByCheckInHotelQueryResponse::BEDS_TWIN ],
                    FindBookingsByCheckInHotelQueryResponse::FULL_BED => $room1[ FindBookingsByCheckInHotelQueryResponse::FULL_BED ],
                    FindBookingsByCheckInHotelQueryResponse::CHECK_IN => $room1[FindBookingsByCheckInHotelQueryResponse::CHECK_IN ],
                    FindBookingsByCheckInHotelQueryResponse::CHECK_OUT => $room1[FindBookingsByCheckInHotelQueryResponse::CHECK_OUT ],
                ],
                [
                FindBookingsByCheckInHotelQueryResponse::NAME => $room2[ FindBookingsByCheckInHotelQueryResponse::NAME ],
                    FindBookingsByCheckInHotelQueryResponse::CAPACITY => $room2[ FindBookingsByCheckInHotelQueryResponse::CAPACITY ],
                    FindBookingsByCheckInHotelQueryResponse::BEDS_TWIN => $room2[ FindBookingsByCheckInHotelQueryResponse::BEDS_TWIN ],
                    FindBookingsByCheckInHotelQueryResponse::FULL_BED => $room2[ FindBookingsByCheckInHotelQueryResponse::FULL_BED ],
                    FindBookingsByCheckInHotelQueryResponse::CHECK_IN => $room2[FindBookingsByCheckInHotelQueryResponse::CHECK_IN ],
                    FindBookingsByCheckInHotelQueryResponse::CHECK_OUT => $room2[FindBookingsByCheckInHotelQueryResponse::CHECK_OUT ],
                ]
            ])
        );
    }

    public function test_it_no_returns_information_query_response_when_hotel_has_not_information(): void
    {
        $this->givenBookingNonExists();
        $this->whenHandlingQuery();
        $this->thenResponseAsIsExpected(new FindBookingsByCheckInHotelQueryResponse([]));
    }

    private function givenBookingExists(): void
    {
        $this->bookingRepository->method('findByCheckIn')->willReturn($this->view);
    }

    private function givenBookingNonExists(): void
    {
        $this->bookingRepository->method('findByCheckIn')->willReturn(null);
    }

    private function whenHandlingQuery(): void
    {
        $this->response = $this->queryHandler->__invoke(FindBookingsByCheckInHotelQuery::create());
    }

    private function thenResponseAsIsExpected(FindBookingsByCheckInHotelQueryResponse $expectedResponse): void
    {
        $this->assertEquals($expectedResponse, $this->response);
    }
}
