<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ClientRepository;
use App\ClientRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //register ClientRepository and ProductService
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
        $this->app->singleton(ProductService::class, function ($app) { return new ProductService(); });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
