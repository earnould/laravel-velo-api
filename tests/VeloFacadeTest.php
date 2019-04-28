<?php

namespace Earnould\LaravelVeloApi\Tests\Unit;

use Illuminate\Support\Collection;
use Earnould\LaravelVeloApi\Facades\Velo;
use Earnould\LaravelVeloApi\Tests\TestCase;

class VeloFacadeTest extends TestCase
{
    /** @test */
    public function it_can_retrieve_all_stations()
    {
        Velo::shouldReceive('stationsStatus')->andReturn();
    }

    /** @test */
    public function it_can_retrieve_all_station_statuses()
    {
        Velo::shouldReceive('stationsStatuses')->andReturn(Collection::class);
    }

    /** @test */
    public function it_can_retrieve_all_station_with_status()
    {
        Velo::shouldReceive('stationsWithStatus')->andReturn(Collection::class);
    }
}
