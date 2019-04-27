<?php

namespace Earnould\LaravelVeloApi\Facades;

use Illuminate\Support\Facades\Facade;

class Velo extends Facade
{
    /**
     * Get VeloFacade.
     *
     * @return void
     */
    protected static function getFacadeAccessor()
    {
        return 'velo';
    }
}
