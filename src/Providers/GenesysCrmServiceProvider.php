<?php

namespace GenesysLite\GenesysCrm\Providers;

use Illuminate\Support\ServiceProvider;

class GenesysCrmServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/genesysCrm.php',
            'genesysFact'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (function_exists('config_path')) { // function not available and 'publish' not relevant in Lumen
            $this->publishes([
                __DIR__.'/../../config/genesysCrm.php' => config_path('genesysCrm.php'),
            ], 'config');
        }
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }
}
