<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\QRCodeInterface;
use App\Services\QRCodeChillerlanService;
use App\Services\QRCodeSimpleSoftwareIOService;

class QRCodeChillerlanServiceProvider extends ServiceProvider
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
        // $this->app->bind(QRCodeInterface::class, QRCodeChillerlanService::class);
        $this->app->bind(QRCodeInterface::class, QRCodeSimpleSoftwareIOService::class);
    }
}
