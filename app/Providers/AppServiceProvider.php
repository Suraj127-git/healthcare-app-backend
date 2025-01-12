<?php

namespace App\Providers;

use app;
use App\Repository\RegisterRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\Mysql\RegisterRepositoryImpl;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RegisterRepository::class, RegisterRepositoryImpl::class);
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
