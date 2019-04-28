<?php

namespace Earnould\LaravelVeloApi\Tests;

class StationTest extends TestCase
{
    protected function setUp() : void
    {
        parent::setUp();
    }

    /** @test */
    public function it_can_refresh_a_stations_status()
    {
        $mock = $this->mockVelo([$this->accessTokenResponse, $this->stationsStatusesResponse]);

        $station = new Station(json_decode($this->getStationsFixture(), true), $mock);

        $this->assertNull($station->status);

        $station->refreshStatus();

        $this->assertNotNull($station->status);
    }
}
