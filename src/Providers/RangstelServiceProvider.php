<?php

namespace Arifsajal\RangstelSmsGateway\Providers;

use Arifsajal\RangstelSmsGateway\Services\RangstelServices;
use Illuminate\Support\ServiceProvider;

class RangstelServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        // Register the service the package provides.
        $this->app->singleton('rangstelsmsgateway', function ($app) {
            return new RangstelServices();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['rangstelsmsgateway'];
    }
}
