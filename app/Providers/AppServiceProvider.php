<?php

namespace App\Providers;

use app\Helpers\Response;
use App\Interfaces\RegisterInterface;
use App\Interfaces\ResponseInterface;
use App\Services\Auth\RegisterService;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();

        $this->app->bind(RegisterInterface::class, RegisterService::class);
        $this->app->bind(ResponseInterface::class, Response::class);
    }
}
