<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Event;
use App\Models\Genre;
use App\Models\Ticket;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return view('admin.event.index',['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $venues = Venue::orderBy('title')->get();
        $tickets = Ticket::orderBy('title')->get();
        $genres = Genre::orderBy('title')->get();
        $artists = Artist::orderBy('nickname')->get();
        return view('admin.event.edit',[
            'venues' => $venues,
            'tickets' => $tickets,
            'genres' => $genres,
            'artists' => $artists,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'unique:events|required|max:255',
        ]);

        $input = $request->except('image');

        if( $request->hasFile('image')){

            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extention = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = "image/".$filename."_".time().".".$extention;
            $path = $request->file('image')->storeAs('public/', $fileNameToStore);

        }
        $input['image'] =$path;

        Event::create($input);
        $id = Event::max('id');

        foreach ($input['tickets'] as $ticket)
        {
            DB::table('event_ticket')->insert([
                'ticket_id' => $ticket,
                'event_id'  => $id,
            ]);
        }
//        $event->tickets()->attach($input['tickets']);
        return redirect()->route('event.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::where('id',$id)->first();
        $venues = Venue::orderBy('title')->get();
        $tickets = Ticket::orderBy('title')->get();
        $genres = Genre::orderBy('title')->get();
        $artists = Artist::orderBy('nickname')->get();

        return view('admin.event.edit',[
            'event' => $event,
            'venues' => $venues,
            'tickets' => $tickets,
            'genres' => $genres,
            'artists' => $artists,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'unique:events|required|max:255',
        ]);
        $event = Event::where('id',$id)->first();

        $input = $request->all();



        if(isset($input['image'])){
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extention = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = "image/".$filename."_".time().".".$extention;
            $path = $request->file('image')->storeAs('public/', $fileNameToStore);
        }

        $event->update($input);

        if(isset($input['image']))
            $event->update(['image' => $path]);


        DB::table('event_ticket')->where('event_id',$id)->delete();
        foreach ($input['tickets'] as $ticket)
        {
            DB::table('event_ticket')->insert([
                'ticket_id' => $ticket,
                'event_id'  => $id,
            ]);
        }
        return redirect()->route('event.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Event::where('id',$id)->delete();
        return redirect()->route('event.index');
    }
}
