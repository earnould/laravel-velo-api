<?php

namespace Earnould\LaravelVeloApi;

use Illuminate\Support\ServiceProvider;
use Earnould\LaravelVeloApi\Tests\Mocks\VeloClientMock;

class VeloServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/laravel-velo-api.php' => config_path('laravel-velo-api.php'),
        ], 'config');

        $this->app->bind(VeloClientInterface::class, function(){
            return new VeloClient();
        });
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-velo-api.php', 'laravel-velo-api');

        $this->app->bind(VeloStations::class);
            
        if (app()->environment('testing')) {
            $this->app->bind('velo-stations', function () {
                return new VeloStations(new VeloClientMock());
            });
        } else {
            $this->app->bind('velo-stations', function () {
                return new VeloStations(new VeloClient());
            });
        }
    }
}
