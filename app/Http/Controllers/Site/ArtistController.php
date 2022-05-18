<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::orderByDesc('created_at')->get();
        return view('site.artist.index', ['items' => $artists]);
    }

    public function single($slug)
    {
        $artist = Artist::where('slug',$slug)->first();
        return view('site.artist.single',['item' => $artist]);
    }
}
