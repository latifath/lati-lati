<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
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
        Paginator::useBootstrap();

        Blade::if('client', function () {
            return auth()->user()->role === 'client';
        });

        Blade::if('admin', function (){
            return auth()->user()->role === 'admin';
        });

        Blade::if('gestionnaire', function (){
            return auth()->user()->role === 'gestionnaire';
        });

        Blade::if('comptable', function (){
            return auth()->user()->role === 'comptable';
        });
    }
}
