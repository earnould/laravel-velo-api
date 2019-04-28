<?php

namespace Earnould\LaravelVeloApi\Facades;

use Illuminate\Support\Facades\Facade;

class VeloStations extends Facade
{
    /**
     * Get VeloFacade.
     *
     * @return void
     */
    protected static function getFacadeAccessor()
    {
        return 'velo-stations';
    }
}
