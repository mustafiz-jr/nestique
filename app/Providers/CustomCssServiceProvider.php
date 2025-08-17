<?php
// app/Providers/CustomCssServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Filament\Facades\Filament;

class CustomCssServiceProvider extends ServiceProvider
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
        Filament::serving(function () {
            Filament::registerStyles([
                '//' . URL::to('/') . '/assets/backend/css/admin.css',
            ]);
        });
    }
}
