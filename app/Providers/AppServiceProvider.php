<?php

namespace App\Providers;

use App\Decorators\CacheUsers;
use App\Decorators\CacheVehicles;
use App\Interfaces\UsersInterface;
use App\Interfaces\VehiclesInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UsersInterface::class, CacheUsers::class);
        $this->app->bind(VehiclesInterface::class, CacheVehicles::class);
    }
}
