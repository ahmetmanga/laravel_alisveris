<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
class IndexProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('sayfa.index','App\Http\Composers\IndexComposer');
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
