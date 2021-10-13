<?php

namespace App\Tests\Unit\Context\Booking\Application\Bus\Query;

use App\Context\Booking\Application\Bus\FindUsersByCheckInHotelQuery;
use App\Context\Booking\Application\Bus\FindUsersByCheckInHotelQueryResponse;
use App\Context\Booking\Application\Bus\FindUsersByCheckInHotelQueryResponseConverter;
use App\Context\Booking\Application\Bus\Query\FindUsersByCheckInQueryHandler;
use App\Context\Booking\Domain\Read\Repository\UserRepository;
use App\Context\Booking\Domain\Read\View\UserView;
use App\Context\Hotel\Application\Bus\FindInformationByIdHotelQuery;
use App\Context\Hotel\Application\Bus\FindInformationByIdHotelQueryResponse;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FindUsersByCheckInQueryHandlerTest extends TestCase
{
    private UserRepository | MockObject $userRepository;
    private FindUsersByCheckInQueryHandler $queryHandler;
    private FindUsersByCheckInHotelQueryResponse $response;
    private UserView $view;
    private FindUsersByCheckInHotelQueryResponseConverter $responseConverter;
    private Generator $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create();
        $this->view = UserView::build(
            [
                $this->faker->name(),
                $this->faker->name(),
            ]
        );
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->responseConverter = new FindUsersByCheckInHotelQueryResponseConverter();
        $this->queryHandler = new FindUsersByCheckInQueryHandler($this->userRepository, $this->responseConverter);
    }

    public function test_it_returns_the_expected_query_response_when_hotel_has_users(): void
    {
        $this->givenUserExists();
        $this->whenHandlingQuery();
        $this->thenResponseAsIsExpected(
            new FindUsersByCheckInHotelQueryResponse($this->view->users())
        );
    }

    public function test_it_no_returns_information_query_response_when_hotel_has_not_information(): void
    {
        $this->givenUserNonExists();
        $this->whenHandlingQuery();
        $this->thenResponseAsIsExpected(new FindUsersByCheckInHotelQueryResponse([]));
    }

    private function givenUserExists(): void
    {
        $this->userRepository->method('findByCheckIn')->willReturn($this->view);
    }

    private function givenUserNonExists(): void
    {
        $this->userRepository->method('findByCheckIn')->willReturn(null);
    }

    private function whenHandlingQuery(): void
    {
        $this->response = $this->queryHandler->__invoke(FindUsersByCheckInHotelQuery::create());
    }

    private function thenResponseAsIsExpected(FindUsersByCheckInHotelQueryResponse $expectedResponse): void
    {
        $this->assertEquals($expectedResponse, $this->response);
    }

    private function thenResponseAsIsNotExpected(FindInformationByIdHotelQueryResponse $expectedResponse): void
    {
        $this->assertEquals($expectedResponse, $this->response);
    }


}
