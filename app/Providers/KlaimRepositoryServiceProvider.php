<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Illuminate\Pagination\Paginator;

class KlaimRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\KlaimRepositoryInterface',
            'App\Repositories\KlaimRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Paginator::useBootstrap();
    }
}
