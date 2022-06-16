<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use SpotifyWebAPI;
class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::orderByDesc('created_at')->paginate(8);
        return view('site.artist.index', ['items' => $artists]);
    }

    public function single($slug)
    {
        $artist = Artist::where('slug',$slug)->first();
        if(is_null($artist)){
            abort(404);
        }
        return view('site.artist.single',['item' => $artist]);
    }

    public function search(Request $request)
    {
        $keywords = $request->keywords;

        $artists = Artist::where('nickname','like','%'.$keywords.'%')->orderByDesc('created_at')->limit(8);

        $returnHtml = view('site.artist.items',['items' => $artists])->render();
        return response()->json(['success' => true,'html' => $returnHtml]);
    }

    public function getSimilar(Request $request)
    {
        $session = new SpotifyWebAPI\Session(
            Config::get('spotify.login'),
            Config::get('spotify.secret')
        );
        $session->requestCredentialsToken();
        $accessToken = $session->getAccessToken();
        $api = new SpotifyWebAPI\SpotifyWebAPI();
        $api->setAccessToken($accessToken);

        $results = $api->search($request->nickname, 'artist',['limit' => 1]);

        if(empty($results->artists->items)){
            return response()->json(['success' => false]);
        }
        foreach ($results->artists->items as $result){
            $item = $result;
        }

        //featured artists
        $recommendations = collect($api->getArtistRelatedArtists($item->id));
        for($i=0;$i<3;$i++){
            $artists[] = $recommendations['artists'][$i];
        }


        $returnHtml = view('site.artist.spotify-items',['artists' => $artists])->render();
        return response()->json(['success' => true,'html' => $returnHtml]);

    }
}
