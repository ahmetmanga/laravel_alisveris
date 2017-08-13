<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
class CategoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      View::composer('sayfa.category','App\Http\Composers\CategoryComposer');
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
