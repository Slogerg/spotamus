<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::orderByDesc('created_at')->get();
        return view('site.genre.index', ['items' => $genres]);
    }

    public function single($slug)
    {
        $genre = Genre::where('slug',$slug)->first();
        return view('site.genre.single',['item' => $genre]);
    }
}
