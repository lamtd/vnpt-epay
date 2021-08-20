<?php

namespace Lamtd\VNPTEpay;

use Illuminate\Support\ServiceProvider;

class VNPTEpayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Lamtd\VNPTEpay\\TestVNPTEpaytController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/views', 'vnpt-epay-demo');
        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/'),
        ]);
    }
}
