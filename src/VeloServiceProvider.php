<?php

namespace Earnould\LaravelVeloApi;

use Illuminate\Support\ServiceProvider;

class VeloServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/laravel-velo-api.php' => config_path('laravel-velo-api.php'),
        ], 'config');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-velo-api.php', 'laravel-velo-api');

        $this->app->bind('velo-api', function () {
            return new Velo(new VeloClient());
        });
    }
}
