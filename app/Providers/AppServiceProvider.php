<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\HomeComposer;
use Illuminate\Pagination\Paginator; 
use Illuminate\Support\Facades\{ Blade, View };

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         View::composer(['front.layout', 'front.index'], HomeComposer::class);
        Paginator::defaultView('view-name');
        Paginator::defaultSimpleView('view-name');
          Blade::if('request', function ($url) {
        return request()->is($url);
    });
    }
}