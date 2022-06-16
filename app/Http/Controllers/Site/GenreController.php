<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Event;
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
        if(is_null($genre)){
            abort(404);
        }
        $featured_artists = Artist::where('genre_id',$genre->id)->limit(3)->get();
        $featured_events =  Event::where('genre_id',$genre->id)->limit(3)->get();
        return view('site.genre.single',
            [
            'item' => $genre,
                'featured_artists' => $featured_artists,
                'featured_events'  => $featured_events,
            ]
        );
    }

    public function search(Request $request)
    {
        $keywords = $request->keywords;

        $genres = Genre::where('title','like','%'.$keywords.'%')->get();

        $returnHtml = view('site.genre.items',['items' => $genres])->render();
        return response()->json(['success' => true,'html' => $returnHtml]);
    }
}
