<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Blade::component('front-layout', \App\View\Components\FrontLayout::class);
        
        // Share contact settings with front layout
        view()->composer('layouts.front', \App\View\Composers\FrontLayoutComposer::class);
    }
}
