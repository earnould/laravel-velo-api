<?php

namespace Earnould\LaravelVeloApi;

use Earnould\LaravelVeloApi\VeloClientInterface;

class VeloStations
{
    protected $veloClient;

    public function __construct(VeloClientInterface $veloClient)
    {
        $this->veloClient = $veloClient;
    }

    public function stations()
    {
        $stations = $this->veloClient->fetchStations()->map(function($station){
            return new Station($station);
        });
        
        return $stations;
    }

    public function stationsStatuses()
    {
        return $this->veloClient->fetchStationsStatuses();
    }

    public function stationsWithStatus()
    {
        $stations = $this->stations();
        $statuses = $this->stationsStatuses();

        $stationsWithStatus = $stations->map(function ($station) use ($statuses) {
            $station->setStatus(collect($statuses)->firstWhere('id', $station->id));
            return $station;
        });

        return $stationsWithStatus;
    }
}
