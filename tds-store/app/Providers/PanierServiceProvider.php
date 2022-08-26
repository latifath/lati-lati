<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\PanierSessionRepository;
use App\Repositories\PanierInterfaceRepository;

class PanierServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PanierInterfaceRepository::class, PanierSessionRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
