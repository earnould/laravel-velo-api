<?php

namespace Earnould\LaravelVeloApi\Tests\Unit;

use Illuminate\Support\Collection;
use Earnould\LaravelVeloApi\Tests\TestCase;
use Earnould\LaravelVeloApi\Facades\VeloStations;

class VeloFacadeTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_all_stations()
    {
        VeloStations::shouldReceive('stationsStatus')->andReturn();
    }

    /** @test */
    public function it_can_retrieve_all_station_statuses()
    {
        VeloStations::shouldReceive('stationsStatuses')->andReturn(Collection::class);
    }

    /** @test */
    public function it_can_retrieve_all_station_with_status()
    {
        VeloStations::shouldReceive('stationsWithStatus')->andReturn(Collection::class);
    }
}
