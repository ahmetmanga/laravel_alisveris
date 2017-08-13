<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
class UserProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      View::composer('sayfa.home','App\Http\Composers\UserComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
