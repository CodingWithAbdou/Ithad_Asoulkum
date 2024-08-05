<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Blade::if('admin', function () {
            return auth()->check() && auth()->user()->hasRole('Admin');
        });
        \Blade::if('agent', function () {
            return auth()->check() && auth()->user()->hasRole('Agent');
        });
    }
}
