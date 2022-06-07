<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderByDesc('created_at')->paginate(10);
        return view('site.event.index', ['items' => $events]);
    }

    public function single($slug)
    {
        $event = Event::where('slug',$slug)->first();
        return view('site.event.single',['item' => $event]);
    }

    public function search(Request $request)
    {
        $keywords = $request->keywords;
        $events = Event::query()->where('title','like','%'.$keywords.'%')->orderByDesc('created_at')->get();
        $returnHtml = view('site.event.items',['items' => $events])->render();
        return response()->json(['success' => true,'html' => $returnHtml]);
    }
}
