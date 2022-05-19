<?php

namespace App\Providers;

use App\Models\Artist;
use App\Models\Event;
use App\Models\Genre;
use App\Observers\ArtistObserver;
use App\Observers\EventObserver;
use App\Observers\GenreObserver;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();

        Artist::observe(ArtistObserver::class);
        Event::observe(EventObserver::class);
        Genre::observe(GenreObserver::class);
    }
}
