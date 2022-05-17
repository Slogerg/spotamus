<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderByDesc('created_at')->get();
        return view('site.event.index', ['items' => $events]);
    }

    public function single($slug)
    {
        $event = Event::where('slug',$slug)->first();
        return view('site.event.single',['item' => $event]);
    }


}
