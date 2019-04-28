<?php

namespace Earnould\LaravelVeloApi\Tests;

use Illuminate\Support\Collection;
use Earnould\LaravelVeloApi\VeloClientInterface;
use Earnould\LaravelVeloApi\Facades\VeloStations;
use Earnould\LaravelVeloApi\Tests\Mocks\VeloClientMock;

class VeloTest extends TestCase
{
    protected function setUp() : void
    {
        parent::setUp();
    }

    /** @test */
    public function it_can_retrieve_all_stations()
    {
        $stations = VeloStations::stations();

        $this->assertInstanceOf(Collection::class, $stations);

        $stationsMock = collect($this->getStationsFixture());

        $this->assertInstanceOf(Collection::class, $stationsMock);
        $this->assertEquals(count($stationsMock), count($stations));
    }

    /** @test */
    public function it_can_retrieve_all_station_statuses()
    {
        $stations_statuses = VeloStations::stationsStatuses();

        $this->assertInstanceOf(Collection::class, $stations_statuses);
        $this->assertEquals(count(collect($this->getStationsStatusesFixture())), count($stations_statuses));
    }

    /** @test */
    public function it_can_retrieve_all_stations_with_their_status()
    {
        $stations_with_statuses = VeloStations::stationsWithStatus();

        $this->assertInstanceOf(Collection::class, $stations_with_statuses);
        $this->assertNotNull($stations_with_statuses->first()->status);
        $this->assertNotNull($stations_with_statuses->first()->name);
    }
}
