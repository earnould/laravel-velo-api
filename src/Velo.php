<?php

namespace Earnould\LaravelVeloApi;

class Velo
{
    protected $veloClient;

    public function __construct(VeloClient $veloClient)
    {
        $this->veloClient = $veloClient;
    }

    public function stations()
    {
        $stations = $this->veloClient->fetchStations();

        return $stations;
    }

    public function stationsStatuses()
    {
        $stationsStatuses = $this->veloClient->fetchStationsStatuses();

        return $stationsStatuses;
    }
}
