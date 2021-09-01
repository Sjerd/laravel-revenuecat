<?php

namespace Sjerd\LaravelRevenuecat;

use Illuminate\Support\ServiceProvider;

class LaravelRevenuecatServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/laravel-revenuecat.php' =>  config_path('laravel-revenuecat.php'),
        ], 'config');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
