<?php

namespace App\Providers;

use App\Models\Artist;
use App\Observers\ArtistObserver;
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
        Artist::observe(ArtistObserver::class);
    }
}
