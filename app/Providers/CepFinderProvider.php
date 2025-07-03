<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Contracts\Foundation\Application;

use App\Consumers\CepFinderConsumer;
class CepFinderProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CepFinderConsumer::class, function (Application $app) {
            return new CepFinderConsumer();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
