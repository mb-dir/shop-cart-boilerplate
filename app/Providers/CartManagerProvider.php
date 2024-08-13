<?php

namespace App\Providers;

use App\Services\CartManager;
use Illuminate\Support\ServiceProvider;

class CartManagerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CartManager::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
