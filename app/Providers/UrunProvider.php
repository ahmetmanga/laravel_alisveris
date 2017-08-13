<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class UrunProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
       View::composer('sayfa.kayit','App\Http\Composers\UrunlerComposer');
       View::composer('sayfa.bilgi_duzenle','App\Http\Composers\UrunlerComposer');
       View::composer('sayfa.sifre_islemleri','App\Http\Composers\UrunlerComposer');
       View::composer('sayfa.adres_ekle','App\Http\Composers\UrunlerComposer');
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
