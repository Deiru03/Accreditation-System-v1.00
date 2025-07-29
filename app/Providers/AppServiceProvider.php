<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\BladeDirectiveServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(BladeDirectiveServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
