<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceLayerServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        $this->app->bind(
            'App\Services\UserServiceInterface',
            'App\Services\UserService'
        );
        $this->app->bind(
            'App\Services\ProductServiceInterface',
            'App\Services\ProductService'
        );
        $this->app->bind(
            'App\Services\SectorServiceInterface',
            'App\Services\SectorService'
        );
        $this->app->bind(
            'App\Services\StoreServiceInterface',
            'App\Services\StoreService'
        );
    }
}
