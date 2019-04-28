<?php
namespace Earnould\LaravelVeloApi;

use Earnould\LaravelVeloApi\VeloClient;

class Station
{
    protected $values = [];
    protected $velo;

    public function __construct(array $args)
    {
        $this->values = $args;
    }

    // public static function all()
    // {
    //     $stations = VeloClient::fetchStations();
    //     $stations = collect($stations)->map(function($station){
    //         return new self($station, $this->velo);
    //     });

    //     return $stations;
    // }

    public function refreshStatus()
    {
        $statuses = VeloStations::stationsStatuses();

        $this->setStatus(collect($statuses)->firstWhere('id', $this->id));

        return $this;
    }

    public function setStatus(array $status)
    {
        $this->values = array_merge($this->values, $status);
    }

    public function __get($key)
    {
        if (!isset($this->values[$key])) {
            return null;
        }

        return $this->values[$key];
    }
    
}
