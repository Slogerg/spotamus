<?php

use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VenueController;
use App\Http\Controllers\Game\GameController;
use App\Http\Controllers\Game\SpotifyController;
use Illuminate\Support\Facades\Route;

//Admin panel
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function (){

        //admin artists
        Route::group(['prefix' => 'artists', 'as' => 'artist.'], function (){
            Route::get('/',[ArtistController::class,'index'])->name('index');
            Route::get('/create',[ArtistController::class,'create'])->name('create');
            Route::get('/edit/{id}',[ArtistController::class,'edit'])->name('edit');
            Route::post('/save',[ArtistController::class,'store'])->name('store');
            Route::put('/update/{id}',[ArtistController::class,'update'])->name('update');
            Route::delete('/delete/{id}',[ArtistController::class,'destroy'])->name('delete');
            Route::get('/artist/spotify/',[ArtistController::class,'artistFromSpotify'])->name('spotify');
            Route::get('/artist/post/',[ArtistController::class,'getArtistFromSpotify'])->name('spotify.post');
            Route::post('/artist/send/',[ArtistController::class,'setArtistFromSpotify'])->name('spotify.send');
        });

        //admin events
        Route::group(['prefix' => 'events', 'as' => 'event.'], function (){
            Route::get('/',[EventController::class,'index'])->name('index');
            Route::get('/create',[EventController::class,'create'])->name('create');
            Route::get('/edit/{id}',[EventController::class,'edit'])->name('edit');
            Route::post('/save',[EventController::class,'store'])->name('store');
            Route::put('/update/{id}',[EventController::class,'update'])->name('update');
            Route::delete('/delete/{id}',[EventController::class,'destroy'])->name('delete');

            Route::post('/create/ticket', [EventController::class, 'createTicket'])->name('create.ticket');
            Route::delete('/delete/ticket/{id}', [EventController::class, 'deleteTicket'])->name('delete.ticket');
        });

        //admin genres
        Route::group(['prefix' => 'genres', 'as'=>'genre.'], function (){
            Route::get('/',[GenreController::class,'index'])->name('index');
            Route::get('/create',[GenreController::class,'create'])->name('create');
            Route::get('/edit/{id}',[GenreController::class,'edit'])->name('edit');
            Route::post('/save',[GenreController::class,'store'])->name('store');
            Route::put('/update/{id}',[GenreController::class,'update'])->name('update');
            Route::delete('/delete/{id}',[GenreController::class,'destroy'])->name('delete');
        });

        //admin tickets
        Route::group(['prefix' => 'tickets', 'as' => 'ticket.'], function (){
            Route::get('/',[TicketController::class,'index'])->name('index');
            Route::get('/create',[TicketController::class,'create'])->name('create');
            Route::get('/edit/{id}',[TicketController::class,'edit'])->name('edit');
            Route::post('/save',[TicketController::class,'store'])->name('store');
            Route::put('/update/{id}',[TicketController::class,'update'])->name('update');
            Route::delete('/delete/{id}',[TicketController::class,'destroy'])->name('delete');
        });

        //admin venues
        Route::group(['prefix' => 'venues', 'as' => 'venue.'], function (){
            Route::get('/',[VenueController::class,'index'])->name('index');
            Route::get('/create',[VenueController::class,'create'])->name('create');
            Route::get('/edit/{id}',[VenueController::class,'edit'])->name('edit');
            Route::post('/save',[VenueController::class,'store'])->name('store');
            Route::put('/update/{id}',[VenueController::class,'update'])->name('update');
            Route::delete('/delete/{id}',[VenueController::class,'destroy'])->name('delete');
        });


        //admin users
        Route::group(['prefix' => 'users', 'as' => 'user.'], function (){
            Route::get('/',[UserController::class,'index'])->name('index');
            Route::get('/create',[UserController::class,'create'])->name('create');
            Route::get('/edit/{id}',[UserController::class,'edit'])->name('edit');
            Route::post('/save',[UserController::class,'store'])->name('store');
            Route::put('/update/{id}',[UserController::class,'update'])->name('update');
            Route::delete('/delete/{id}',[UserController::class,'destroy'])->name('delete');
        });
    });
});


//Spotify game
Route::prefix('game')->group(function (){
//    Route::get('/spotify',[SpotifyController::class,'index'])->name('spotify');  --unused
    Route::get('/play',[GameController::class,'index'])->name('game');
    Route::get('/timeout',[\App\Http\Controllers\Game\GameController::class,'index'])->name('timeout');
    Route::post('/guess',[\App\Http\Controllers\Game\GuessController::class,'store'])->name('game.guess');
    Route::get('/home',[\App\Http\Controllers\Game\HomeController::class,'index'])->name('game.home');
    Route::get('/leaderboard',[\App\Http\Controllers\Game\LeaderboardController::class,'index'])->name('game.leaderboard');
    Route::get('/endtest',[\App\Http\Controllers\Game\EndTestController::class,'index'])->name('endtest');
    Route::get('/currentPlaylist',[\App\Http\Controllers\Game\GameController::class,'indexPlaylist'])->name('currentPlaylist');

    Route::post('/putPlaylist',[\App\Http\Controllers\Game\PlaylistController::class,'putPlaylist'])->name('game.putPlaylist');
    Route::get('/playlist',[\App\Http\Controllers\Game\PlaylistController::class,'index'])->name('game.playlist');
    Route::get('/select-playlist',[\App\Http\Controllers\Game\PlaylistController::class, 'selectPlaylist'])->name('game.select.playlist');

    Route::post('/putPlaylistFromImages/{id}',[\App\Http\Controllers\Game\PlaylistController::class, 'putPlaylistFromImages'])->name('game.putPlaylistFromImages');

});

//Front View of Site
Route::get('/events',[\App\Http\Controllers\Site\EventController::class,'index'])->name('front.events');
Route::get('/event/{slug}',[\App\Http\Controllers\Site\EventController::class,'single'])->name('front.event.show');
Route::get('/search/event',[\App\Http\Controllers\Site\EventController::class,'search'])->name('front.event.search');
Route::get('/',[\App\Http\Controllers\HomeController::class,'index'])->name('home');

Route::get('/genres',[\App\Http\Controllers\Site\GenreController::class,'index'])->name('front.genres');
Route::get('/genre/{slug}',[\App\Http\Controllers\Site\GenreController::class,'single'])->name('front.genre.show');
Route::get('/search/genre',[\App\Http\Controllers\Site\GenreController::class,'search'])->name('front.genre.search');

Route::get('/artists',[\App\Http\Controllers\Site\ArtistController::class,'index'])->name('front.artists');
Route::get('/artist/{slug}',[\App\Http\Controllers\Site\ArtistController::class,'single'])->name('front.artist.show');
Route::get('/search/artist',[\App\Http\Controllers\Site\ArtistController::class,'search'])->name('front.artist.search');

Route::get('/getSimilar/artists}',[\App\Http\Controllers\Site\ArtistController::class,'getSimilar'])->name('get.similar.artists');

Route::post('/upvote',[\App\Http\Controllers\Site\UpvoteController::class, 'upvote'])->middleware(['auth'])->name('upvote');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';


