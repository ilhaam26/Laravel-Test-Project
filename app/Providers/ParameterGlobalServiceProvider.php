<?php

namespace App\Providers;

use App\Services\ParameterGlobalService;
use Illuminate\Support\ServiceProvider;

class ParameterGlobalServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\ParameterGlobalService', function ($app) {
            return new ParameterGlobalService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
