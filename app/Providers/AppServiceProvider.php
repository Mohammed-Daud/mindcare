<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

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
        // Force HTTPS in production, but not for ngrok URLs in local environment
        // if (config('app.env') === 'production' || 
        //     (config('app.env') === 'local' && !str_contains(request()->getHost(), 'ngrok-free.app'))) {
        //     URL::forceScheme('https');
        // }
        Schema::defaultStringLength(191);
    }
}
