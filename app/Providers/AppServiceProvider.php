<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Events\{UserCreated,
                UserRememberPassword};
use App\Listeners\{WelcomeUser,
                  NotificationUserRememberPassword};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

     protected $listen = [
        UserCreated::class => [
            WelcomeUser::class,
        ],
        UserRememberPassword::class => [
            NotificationUserRememberPassword::class,
        ],
    ];

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
