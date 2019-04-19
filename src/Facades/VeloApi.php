<?php

namespace Earnould\LaravelVeloApi\Facades;

use Illuminate\Support\Facades\Facade;

class VeloApi extends Facade
{
    /**
     * Get VeloFacade.
     *
     * @return void
     */
    protected static function getFacadeAccessor()
    {
        return 'velo-api';
    }
}
