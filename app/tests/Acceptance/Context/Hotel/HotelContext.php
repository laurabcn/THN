<?php

namespace App\Tests\Acceptance\Context\Hotel;

use App\Context\Hotel\Domain\Write\Aggregate\Information;
use App\Context\Hotel\Domain\Write\Repository\InformationRepository;
use Behat\Behat\Context\Context;
use PHPUnit\Framework\Assert;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;

final class HotelContext implements Context
{

    public function __construct(
        private InformationRepository $informationRepository,
        private KernelInterface $kernel
    )
    {
    }

    /**
     * @Given An hotel with id :id
     */
    public function anHotelWithId($id)
    {
        $information = new Information(
            $id,
            'hotel encantador',
            4,
            3,
            true,
            true,
            true,
            true,
            true,
            false,
            false,
            'vine'
        );

        $this->informationRepository->save($information);
    }

    /**
     * @When /^A "([^"]*)" request body is sent to "([^"]*)"$/
     */
    public function aRequestBodyIsSentTo($method, $endpoint)
    {
        $request = Request::create($endpoint, $method);
        $request->headers->set('202', 'application/json');

        $this->response = $this->kernel->handle($request);
    }

    /**
     * @Then /^the response should be "([^"]*)"$/
     */
    public function theResponseShouldBe($arg1)
    {
        $expected = (int) $arg1;
        $actual = $this->response->getStatusCode();

        Assert::assertSame(
            $expected,
            $actual,
            "Expected HTTP Status Code $expected . Actual: $actual"
        );
    }
}
