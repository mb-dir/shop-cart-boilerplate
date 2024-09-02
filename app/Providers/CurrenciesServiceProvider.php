<?php

namespace App\Providers;

use App\Services\CurrenciesService;
use Illuminate\Support\ServiceProvider;

class CurrenciesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void {}

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->singleton(CurrenciesService::class);
    }
}
