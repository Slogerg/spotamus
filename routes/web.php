<?php

use App\Http\Controllers\Admin\ArtistController;
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

Route::prefix('admin')->group(function (){
    Route::prefix('artists')->group(function (){
        Route::get('/',[ArtistController::class,'index'])->name('artist.index');
        Route::get('/create',[ArtistController::class,'create'])->name('artist.create');
        Route::get('/edit/{id}',[ArtistController::class,'edit'])->name('artist.edit');
        Route::post('/save',[ArtistController::class,'store'])->name('artist.store');
        Route::put('/update/{id}',[ArtistController::class,'update'])->name('artist.update');
        Route::delete('/delete/{id}',[ArtistController::class,'destroy'])->name('artist.delete');
    });
});

Route::get('/', function () {
    return view('admin.welcome');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
