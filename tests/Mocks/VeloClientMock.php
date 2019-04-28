<?php

namespace Earnould\LaravelVeloApi\Tests\Mocks;

use Illuminate\Support\Collection;
use Earnould\LaravelVeloApi\Tests\TestHelper;
use Earnould\LaravelVeloApi\VeloClientInterface;

class VeloClientMock implements VeloClientInterface
{
    use TestHelper;

    /**
     * Fetch all Velo stations.
     *
     * @return Collection
     */
    public function fetchStations() : Collection
    {
        return collect(json_decode(json_encode($this->getStationsFixture()), true));
    }

    /**
     * Fetch all Velo stations statuses.
     *
     * @return Collection
     */
    public function fetchStationsStatuses() : Collection
    {
        return collect(json_decode(json_encode($this->getStationsStatusesFixture()), true));
    }
}
