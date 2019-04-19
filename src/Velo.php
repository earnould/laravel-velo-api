<?php

namespace Earnould\LaravelVeloApi;

class Velo
{
    protected $client;

    public function __construct(VeloClient $veloClient)
    {
        $this->veloClient = $veloClient;
    }

    public function stations(){
        return $this->veloClient->fetchStations();
    }

    public function stationsStatuses(){
        return $this->veloClient->fetchStationsStatuses();
    }
}