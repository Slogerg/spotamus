<?php

use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VenueController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Admin panel
Route::prefix('admin')->group(function (){
    Route::prefix('artists')->group(function (){
        Route::get('/',[ArtistController::class,'index'])->name('artist.index');
        Route::get('/create',[ArtistController::class,'create'])->name('artist.create');
        Route::get('/edit/{id}',[ArtistController::class,'edit'])->name('artist.edit');
        Route::post('/save',[ArtistController::class,'store'])->name('artist.store');
        Route::put('/update/{id}',[ArtistController::class,'update'])->name('artist.update');
        Route::delete('/delete/{id}',[ArtistController::class,'destroy'])->name('artist.delete');
    });

    Route::prefix('events')->group(function (){
        Route::get('/',[EventController::class,'index'])->name('event.index');
        Route::get('/create',[EventController::class,'create'])->name('event.create');
        Route::get('/edit/{id}',[EventController::class,'edit'])->name('event.edit');
        Route::post('/save',[EventController::class,'store'])->name('event.store');
        Route::put('/update/{id}',[EventController::class,'update'])->name('event.update');
        Route::delete('/delete/{id}',[EventController::class,'destroy'])->name('event.delete');
    });

    Route::prefix('genres')->group(function (){
        Route::get('/',[GenreController::class,'index'])->name('genre.index');
        Route::get('/create',[GenreController::class,'create'])->name('genre.create');
        Route::get('/edit/{id}',[GenreController::class,'edit'])->name('genre.edit');
        Route::post('/save',[GenreController::class,'store'])->name('genre.store');
        Route::put('/update/{id}',[GenreController::class,'update'])->name('genre.update');
        Route::delete('/delete/{id}',[GenreController::class,'destroy'])->name('genre.delete');
    });

    Route::prefix('tickets')->group(function (){
        Route::get('/',[TicketController::class,'index'])->name('ticket.index');
        Route::get('/create',[TicketController::class,'create'])->name('ticket.create');
        Route::get('/edit/{id}',[TicketController::class,'edit'])->name('ticket.edit');
        Route::post('/save',[TicketController::class,'store'])->name('ticket.store');
        Route::put('/update/{id}',[TicketController::class,'update'])->name('ticket.update');
        Route::delete('/delete/{id}',[TicketController::class,'destroy'])->name('ticket.delete');
    });

    Route::prefix('venues')->group(function (){
        Route::get('/',[VenueController::class,'index'])->name('venue.index');
        Route::get('/create',[VenueController::class,'create'])->name('venue.create');
        Route::get('/edit/{id}',[VenueController::class,'edit'])->name('venue.edit');
        Route::post('/save',[VenueController::class,'store'])->name('venue.store');
        Route::put('/update/{id}',[VenueController::class,'update'])->name('venue.update');
        Route::delete('/delete/{id}',[VenueController::class,'destroy'])->name('venue.delete');
    });

    Route::prefix('users')->group(function (){
        Route::get('/',[UserController::class,'index'])->name('user.index');
        Route::get('/create',[UserController::class,'create'])->name('user.create');
        Route::get('/edit/{id}',[UserController::class,'edit'])->name('user.edit');
        Route::post('/save',[UserController::class,'store'])->name('user.store');
        Route::put('/update/{id}',[UserController::class,'update'])->name('user.update');
        Route::delete('/delete/{id}',[UserController::class,'destroy'])->name('user.delete');
    });
});

//Spotify game
Route::prefix('game')->group(function (){
    Route::get('/spotify',[\App\Http\Controllers\Game\SpotifyController::class,'index'])->name('spotify');
    Route::get('/play',[\App\Http\Controllers\Game\GameController::class,'index'])->name('game');
    Route::get('/timeout',[\App\Http\Controllers\Game\GameController::class,'index'])->name('timeout');
    Route::post('/guess',[\App\Http\Controllers\Game\GuessController::class,'store'])->name('game.guess');
    Route::get('/home',[\App\Http\Controllers\Game\HomeController::class,'index'])->name('game.home');
    Route::get('/leaderboard',[\App\Http\Controllers\Game\LeaderboardController::class,'index'])->name('game.leaderboard');
    Route::get('/endtest',[\App\Http\Controllers\Game\EndTestController::class,'index'])->name('endtest');
    Route::get('/currentPlaylist',[\App\Http\Controllers\Game\GameController::class,'indexPlaylist'])->name('currentPlaylist');

    Route::post('/putPlaylist',[\App\Http\Controllers\Game\PlaylistController::class,'putPlaylist'])->name('game.putPlaylist');
    Route::get('/playlist',[\App\Http\Controllers\Game\PlaylistController::class,'index'])->name('game.playlist');
});

//Front View of Site
Route::get('/events',[\App\Http\Controllers\Site\EventController::class,'index'])->name('front.events');
Route::get('/event/{slug}',[\App\Http\Controllers\Site\EventController::class,'single'])->name('front.event.show');
Route::get('/search/event',[\App\Http\Controllers\Site\EventController::class,'search'])->name('front.event.search');

Route::get('/genres',[\App\Http\Controllers\Site\GenreController::class,'index'])->name('front.genres');
Route::get('/genre/{slug}',[\App\Http\Controllers\Site\GenreController::class,'single'])->name('front.genre.show');
Route::get('/search/genre',[\App\Http\Controllers\Site\GenreController::class,'search'])->name('front.genre.search');

Route::get('/artists',[\App\Http\Controllers\Site\ArtistController::class,'index'])->name('front.artists');
Route::get('/artist/{slug}',[\App\Http\Controllers\Site\ArtistController::class,'single'])->name('front.artist.show');
Route::get('/search/artist',[\App\Http\Controllers\Site\ArtistController::class,'search'])->name('front.artist.search');

Route::post('/upvote',[\App\Http\Controllers\Site\UpvoteController::class, 'upvote'])->middleware(['auth'])->name('upvote');

Route::get('/', function () {
    return view('home');
})->name('home');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
