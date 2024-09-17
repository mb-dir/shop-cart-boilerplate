<?php

namespace App\Providers;


use App\Services\AffiliateService;
use Illuminate\Support\ServiceProvider;


class AffiliateServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->singleton(AffiliateService::class);
    }


    public function register()
    {

    }
}