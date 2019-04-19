<?php
namespace Earnould\LaravelVeloApi\Tests;

use Closure;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Earnould\LaravelVeloApi\VeloClient;
use Earnould\LaravelVeloApi\Exceptions\VeloException;

class VeloClientTest extends TestCase
{
    protected function setUp() : void
    {
        parent::setUp();

        $this->accessToken = "YWM4ZGRlZDA4MWQxNDM4MmMyOGRjNGQ3YTI1NzE3NjRhMTNiODlhZTM2ZmFlNmVhOTA1ZTMxMDQ3OWZlOTEzYw";
        
        $this->veloClient = new VeloClient(new Client());
    }

    /** 
     * @test 
    */
    public function it_returns_a_valid_token()
    {
        $mock = $this->mockVeloClient([$this->accessTokenResponse]);
        $access_token = $mock->getAccessToken();

        $this->assertSame($this->accessToken, $mock->getAccessToken());
        $this->assertTrue(is_string($access_token), "Got a " . gettype($access_token) . " instead of a string.");
        $this->assertStringContainsString($this->getAccessTokenFixture(), Cache::get('access_token'));
    }

    /** 
     * @test 
    */
    public function it_returns_no_valid_token()
    {
        $mock = $this->mockVeloClient([$this->emptyAccessTokenResponse]);

        $this->expectException(VeloException::class);
        $mock->getAccessToken();
    }

    /** @test */
    public function it_fetches_stations()
    {   
        $mock = $this->mockVeloClient([$this->accessTokenResponse, $this->stationsResponse]);
        $stations = $mock->fetchStations();

        $this->assertInstanceOf(Collection::class, $stations);
        $this->assertArrayHasKey('name', get_object_vars($stations->first()));
    }

    /** @test */
    public function it_fails_to_fetch_stations()
    {
        $mock = $this->mockVeloClient([$this->accessTokenResponse, $this->faultyStationsResponse]);

        $this->expectException(VeloException::class);
        $mock->fetchStations();
    }

    /** @test */
    public function it_fails_to_fetch_stations_without_access_token()
    {
        $mock = $this->mockVeloClient([$this->emptyAccessTokenResponse, $this->faultyStationsResponse]);

        $this->expectException(VeloException::class);
        $mock->fetchStations();
    }

    /** @test */
    public function it_fetches_stations_statuses()
    {
        $mock = $this->mockVeloClient([$this->accessTokenResponse, $this->stationsStatusesResponse]);
        $stations_statuses = $mock->fetchStationsStatuses();
        
        $this->assertInstanceOf(Collection::class, $stations_statuses);
        $this->assertArrayHasKey('status', get_object_vars($stations_statuses->first()));
    }

    /** @test */
    public function it_fails_to_fetch_stations_statuses()
    {
        $mock = $this->mockVeloClient([$this->accessTokenResponse, $this->faultyStationsStatusesResponse]);

        $this->expectException(VeloException::class);
        $mock->fetchStationsStatuses();
    }

    /** @test */
    public function it_fails_to_fetch_stations_statuses_without_access_token()
    {
        $mock = $this->mockVeloClient([$this->emptyAccessTokenResponse, $this->faultyStationsStatusesResponse]);

        $this->expectException(VeloException::class);
        $mock->fetchStationsStatuses();
    }
}