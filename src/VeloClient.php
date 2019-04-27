<?php

namespace Earnould\LaravelVeloApi;

use Closure;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Earnould\LaravelVeloApi\Exceptions\VeloException;

class VeloClient
{
    private $guzzleClient;
    private $client_id;
    private $client_secret;
    private $token_url;
    private $api_url;
    private $apiResponseFormat;

    public function __construct(Client $client = null)
    {
        $this->guzzleClient = $client ?: new Client();
        $this->client_id = config('laravel-velo-api.client_id');
        $this->client_secret = config('laravel-velo-api.client_secret');
        $this->token_url = 'https://antwerp.pub.api.smartbike.com/oauth/v2/token';
        $this->api_url = 'https://antwerp.pub.api.smartbike.com/api/en/v3';
        $this->apiResponseFormat = '.json';
    }

    /**
     * Request Velo API Access Token response.
     *
     * @return void
     */
    private function requestAccessToken() : string
    {
        $response = $this->guzzleClient->post($this->token_url, [
            'form_params'   =>  [
                'client_id'     => $this->client_id,
                'client_secret' => $this->client_secret,
                'grant_type'    => 'client_credentials',
            ],
        ]);

        $access_token = json_decode($response->getBody()->getContents())->access_token;

        if (! empty($access_token)) {
            return $access_token;
        }

        throw new VeloException('An access token is required to perform requests tothe Velo API', 403);
    }

    /**
     * Get cached token or request a new one.
     *
     * @return void
     */
    public function getAccessToken() : string
    {
        return Cache::remember('access_token', 55, Closure::fromCallable([$this, 'requestAccessToken']));
    }

    /**
     * Prepare the uri for a request.
     *
     * @param $resource
     * @return string
     */
    private function prepareUri($resource) : string
    {
        $uri = $this->api_url.'/'.$resource.$this->apiResponseFormat;

        return $uri;
    }

    /**
     * Fetch all Velo stations.
     *
     * @return Collection
     */
    public function fetchStations() : Collection
    {
        $response = $this->guzzleClient->get($this->prepareUri('stations'), [
            'headers' => [
                'Authorization' => 'Bearer '.$this->getAccessToken(),
            ],
        ]);
        
        try {
            $stations = json_decode($response->getBody()->getContents())->stations;
        } catch (\ErrorException $e) {
            throw new VeloException($e->getMessage(), $e->getCode());
        }

        return collect($stations);
    }

    /**
     * Fetch all Velo stations statuses.
     *
     * @return Collection
     */
    public function fetchStationsStatuses() : Collection
    {
        $response = $this->guzzleClient->get($this->prepareUri('stations/status'), [
            'headers' => [
                'Authorization' => 'Bearer '.$this->getAccessToken(),
            ],
        ]);

        try {
            $stationsStatuses = json_decode($response->getBody()->getContents())->stationsStatus;
        } catch (\ErrorException $e) {
            throw new VeloException($e->getMessage(), $e->getCode());
        }

        return collect($stationsStatuses);
    }

    public function fetchStationsWithStatus()
    {
        $stations = $this->fetchStations();
        $statuses = $this->fetchStationsStatuses();

        $stationsWithStatus = $stations->map(function($station) use($statuses){
            return (object) array_merge((array)$station, (array) collect($statuses)->firstWhere('id', $station->id));
        });

        return $stationsWithStatus;
    }
}
