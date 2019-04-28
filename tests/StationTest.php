<?php

namespace Earnould\LaravelVeloApi\Tests;

use Earnould\LaravelVeloApi\Station;

class StationTest extends TestCase
{
    protected function setUp() : void
    {
        parent::setUp();
    }

    /** @test */
    public function it_can_refresh_a_stations_status()
    {
        $station = new Station(json_decode(json_encode($this->getStationsFixture()), true)[0]);

        $this->assertNull($station->status);

        $station->refreshStatus();

        $this->assertNotNull($station->status);
    }
}
