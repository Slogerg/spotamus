<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderByDesc('created_at')->paginate(8);
        return view('site.event.index', ['items' => $events]);
    }

    public function single($slug)
    {
        $event = Event::where('slug',$slug)->first();
        $artist = Artist::where('id', $event->artist_id)->first();
        if(is_null($event)){
            abort(404);
        }
        return view('site.event.single',['item' => $event, 'artist' => $artist]);
    }

    public function search(Request $request)
    {
        $keywords = $request->keywords;
        $events = Event::query()->where('title','like','%'.$keywords.'%')->orderByDesc('created_at')->limit(8)->paginate(8);
        $returnHtml = view('site.event.items',['items' => $events])->render();
        return response()->json(['success' => true,'html' => $returnHtml]);
    }
}
