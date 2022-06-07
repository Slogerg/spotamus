<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use SpotifyWebAPI;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $artists = Artist::orderByDesc('id')->paginate(10);
        return view('admin.artist.index',['artists' => $artists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.artist.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //add image uploader

        $request->validate([
            'nickname' => 'required|max:255',
        ]);

        $input = $request->except('image');

        if(Artist::where('nickname',$input['nickname'])->exists()){
            $input['nickname'] = $input['nickname'].'-'.Carbon::now();
        }



        if( $request->hasFile('image')){

            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extention = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = "image/".$filename."_".time().".".$extention;
            $path = $request->file('image')->storeAs('public/', $fileNameToStore);

        }
        $input['image'] =$path;
        Artist::create($input);

        return redirect()->route('artist.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $artist = Artist::where('id',$id)->first();
        return view('admin.artist.edit',['artist' => $artist]);
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
            'nickname' => 'unique:artists|required|max:255',
        ]);
        $artist = Artist::where('id',$id)->first();

        $input = $request->all();


        if(isset($input['image'])){
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extention = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = "image/".$filename."_".time().".".$extention;
            $path = $request->file('image')->storeAs('public/', $fileNameToStore);
        }

        $artist->update($input);

        if(isset($input['image']))
            $artist->update(['image' => $path]);


        return redirect()->route('artist.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Artist::where('id',$id)->delete();
        return redirect()->route('artist.index');
    }

    public function artistFromSpotify()
    {
        return view('admin.artist.spotify');
    }

    public function getArtistFromSpotify(Request $request)
    {
        $session = new SpotifyWebAPI\Session(
            Config::get('spotify.login'),
            Config::get('spotify.secret')
        );
        $session->requestCredentialsToken();
        $accessToken = $session->getAccessToken();
        $api = new SpotifyWebAPI\SpotifyWebAPI();
        $api->setAccessToken($accessToken);
//        dd($api->getArtist('https://open.spotify.com/artist/3AA28KZvwAUcZuOKwyblJQ'));

        $results = $api->search($request->name, 'artist',['limit' => 3]);
//dd($results);
        $returnHtml = view('admin.artist.spotify-items',['items' => $results])->render();
        return response()->json(['success' => true,'html' => $returnHtml]);

    }

    public function setArtistFromSpotify(Request $request)
    {
        $data = $request->except('_token');
        Artist::create($data);

        return redirect()->route('artist.index');
    }
}
