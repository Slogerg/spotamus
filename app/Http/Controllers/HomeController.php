<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Event;
use App\Models\Genre;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $featured_artist = Artist::orderByDesc('upvotes')->first();

        $last_event = Event::orderByDesc('created_at')->first();
        $genres = Genre::orderBy('id')->limit(12)->get();


        return view('home',
            [
                'featured_artist' => $featured_artist,
                'last_event' => $last_event,
                'genres'     => $genres
            ]);
    }
}
