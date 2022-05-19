<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::orderByDesc('created_at')->paginate(10);
        return view('site.artist.index', ['items' => $artists]);
    }

    public function single($slug)
    {
        $artist = Artist::where('slug',$slug)->first();
        return view('site.artist.single',['item' => $artist]);
    }

    public function search(Request $request)
    {
        $keywords = $request->keywords;

        $artists = Artist::where('nickname','like','%'.$keywords.'%')->get();

        $returnHtml = view('site.artist.items',['items' => $artists])->render();
        return response()->json(['success' => true,'html' => $returnHtml]);
    }
}
