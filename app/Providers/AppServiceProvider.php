<?php

namespace App\Providers;

use App\Providers\Views\BladeStatements;
use App\Services\Notify\EmailNotifyService;
use App\Services\Notify\NotifyInterface;
use App\Services\Orders\Repositories\EloquentOrderRepository;
use App\Services\Orders\Repositories\OrderRepositoryInterface;
use App\Services\Weather\OpenWeatherMapService;
use App\Services\Weather\WeatherInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    use BladeStatements;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(WeatherInterface::class, OpenWeatherMapService::class);
        $this->app->bind(OrderRepositoryInterface::class, EloquentOrderRepository::class);
        $this->app->bind(NotifyInterface::class, EmailNotifyService::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->bootBladeStatements();
    }
}
