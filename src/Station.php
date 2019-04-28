<?php

namespace Earnould\LaravelVeloApi;

use Earnould\LaravelVeloApi\Facades\VeloStations;

class Station
{
    protected $values = [];

    public function __construct(array $args)
    {
        $this->values = $args;
    }

    public function refreshStatus()
    {
        $statuses = VeloStations::statuses();
        $this->setStatus($statuses->firstWhere('id', $this->id));

        return $this;
    }

    public function setStatus(array $status)
    {
        $this->values = array_merge($this->values, $status);
    }

    public function __get($key)
    {
        if (!isset($this->values[$key])) {
            return;
        }

        return $this->values[$key];
    }
}
