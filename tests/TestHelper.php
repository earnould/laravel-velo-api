<?php

namespace Earnould\LaravelVeloApi\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use Earnould\LaravelVeloApi\VeloClient;

trait TestHelper
{
    protected $apiClient;

    public function getTestPath()
    {
        return __DIR__.'/';
    }

    public function getFixturesPath()
    {
        return $this->getTestPath().'fixtures/';
    }

    public function getFixture($fixture_name)
    {
        return json_decode(file_get_contents($this->getFixturesPath() . $fixture_name . '.json'));
    }

    public function getAccessTokenFixture()
    {
        return $this->getFixture('access_token')->access_token;
    }

    public function getStationsFixture()
    {
        return $this->getFixture('stations')->stations;
    }

    public function getStationsStatusesFixture()
    {
        return $this->getFixture('stations_statuses')->stationsStatus;
    }

    public function getTestCaseFixture($fixture_name)
    {
        return json_encode($this->getFixture($fixture_name));
    }

    public function mockVeloClient(array $responseHandlers)
    {
        $mock = new MockHandler($responseHandlers);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        return new VeloClient($client);
    }
}
