<?php
namespace Earnould\LaravelVeloApi\Tests\Unit;

use Earnould\LaravelVeloApi\Tests\TestCase;
use Illuminate\Support\Collection;
use Earnould\LaravelVeloApi\Facades\VeloApi;

class VeloApiTest extends TestCase 
{
    /** @test */
    public function it_can_retrieve_all_stations(){
        VeloApi::shouldReceive('stationsStatus')->andReturn();
    }

    /** @test */
    public function it_can_retrieve_all_station_statuses(){
        VeloApi::shouldReceive('stationsStatuses')->andReturn(Collection::class);
    }
}