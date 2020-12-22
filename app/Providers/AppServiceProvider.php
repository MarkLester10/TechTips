<?php

namespace App\Providers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

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
        //To let Laravel Sessions available to Vue Components and can be access  by using $page.flash.{key}
        Inertia::share('flash', function () {
            return [
                'success' => Session::get('success'),
                'failure' => Session::get('failure')
            ];
        });
    }
}