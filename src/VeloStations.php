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

    public function all()
    {
        $stations = $this->veloClient->fetchStations()->map(function($station){
            return new Station($station);
        });
        
        return $stations;
    }

    public function allWithStatus()
    {
        $stations = $this->all();
        $statuses = $this->statuses();

        $stationsWithStatus = $stations->map(function ($station) use ($statuses) {
            $station->setStatus(collect($statuses)->firstWhere('id', $station->id));
            return $station;
        });

        return $stationsWithStatus;
    }

    public function statuses()
    {
        return $this->veloClient->fetchStationsStatuses();
    }
}
