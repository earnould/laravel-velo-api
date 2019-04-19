<?php

namespace Earnould\LaravelVeloApi\Tests;

use GuzzleHttp\Psr7\Response;
use Orchestra\Testbench\TestCase as Orchestra;
use Earnould\LaravelVeloApi\VeloServiceProvider;

abstract class TestCase extends Orchestra
{
    use TestHelper;

    protected function setUp() : void
    {
        parent::setUp();

        $this->client_id = config('laravel-velo-api.client_id');
        $this->client_secret = config('laravel-velo-api.client_secret');
        $this->token_url = 'https://antwerp.pub.api.smartbike.com/oauth/v2/token';
        $this->api_url = 'https://antwerp.pub.api.smartbike.com/api/en/v3';
        $this->apiResponseFormat = '.json';

        $this->accessTokenResponse = new Response(200, [], $this->getFixture('access_token'));
        $this->stationsResponse = new Response(200, [], $this->getFixture('stations'));
        $this->stationsStatusesResponse = new Response(200, [], $this->getFixture('stations_statuses'));

        $this->emptyAccessTokenResponse = new Response(200, [], $this->getFixture('empty_access_token'));
        $this->faultyStationsResponse = new Response(200, [], $this->getFixture('faulty_stations'));
        $this->faultyStationsStatusesResponse = new Response(200, [], $this->getFixture('faulty_stations_statuses'));
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [VeloServiceProvider::class];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'Velo' => VeloFacade::class,
        ];
    }
}
