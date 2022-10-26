<?php

namespace App\Providers;

use App\Repositories\ProductRepository;
use App\Repositories\ProductRepositoryEloquent;
use App\Repositories\SectorRepository;
use App\Repositories\SectorRepositoryEloquent;
use App\Repositories\StoreRepository;
use App\Repositories\StoreRepositoryEloquent;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            SectorRepository::class,
            SectorRepositoryEloquent::class
        );
        $this->app->bind(
            UserRepository::class,
            UserRepositoryEloquent::class
        );
        $this->app->bind(
            ProductRepository::class,
            ProductRepositoryEloquent::class
        );
        $this->app->bind(
            StoreRepository::class,
            StoreRepositoryEloquent::class
        );
    }
}
