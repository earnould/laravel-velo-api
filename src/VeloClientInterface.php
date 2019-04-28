<?php

namespace Earnould\LaravelVeloApi;

use Illuminate\Support\Collection;

interface VeloClientInterface
{
    /**
     * Fetch all Velo stations.
     *
     * @return Collection
     */
    public function fetchStations() : Collection;

    /**
     * Fetch all Velo stations statuses.
     *
     * @return Collection
     */
    public function fetchStationsStatuses() : Collection;
}