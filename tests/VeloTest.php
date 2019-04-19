<?php
namespace Earnould\LaravelVeloApi\Tests;

use Illuminate\Support\Collection;
use Earnould\LaravelVeloApi\Tests\TestCase;

class VeloTest extends TestCase 
{
    protected function setUp() : void
    {
        parent::setUp();
    }
    /** @test */
    public function it_can_retrieve_all_stations(){
        $mock = $this->mockVelo([$this->accessTokenResponse, $this->stationsResponse]);

        $stations = $mock->stations();
        $this->assertInstanceOf(Collection::class, $stations);

        $stationsMock = collect($this->getStationsFixture());
        $this->assertInstanceOf(Collection::class, $stationsMock);
        $this->assertEquals($stationsMock, $stations);
    }

    /** @test */
    public function it_can_retrieve_all_station_statuses(){
        $mock = $this->mockVelo([$this->accessTokenResponse, $this->stationsStatusesResponse]);

        $stationsStatuses = $mock->stationsStatuses();
        $this->assertInstanceOf(Collection::class, $stationsStatuses);
        $this->assertEquals(collect($this->getStationsStatusesFixture()), $stationsStatuses);
    }
}