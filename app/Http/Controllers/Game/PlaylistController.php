<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use SpotifyWebAPI;


class PlaylistController extends Controller
{
    public function index()
    {
        return view('game.form-playlist');
    }

    public function putPlaylist(Request $request)
    {

        User::where('id',Auth::user()->id)->update([
            'currentPlaylist' => $request->playlist,
        ]);

        return redirect()->route('game');
    }

    public function selectPlaylist()
    {
        $session = new SpotifyWebAPI\Session(
            Config::get('spotify.login'),
            Config::get('spotify.secret')
        );
        $session->requestCredentialsToken();
        $accessToken = $session->getAccessToken();
        $api = new SpotifyWebAPI\SpotifyWebAPI();
        $api->setAccessToken($accessToken);
        $playlist_ids = [
            '37i9dQZF1DWXRqgorJj26U',
            '3RcRK9HGTAm9eLW1LepWKZ',
            '37i9dQZF1DXbITWG1ZJKYt',
            '37i9dQZF1DWWEJlAGA9gs0',
            '37i9dQZF1DZ06evO0nT692',
            '37i9dQZF1DWUxthdWUs4N4',
            '37i9dQZF1DZ06evO1BzWmZ',
            '37i9dQZF1DZ06evO0vHxgw'
        ];
        foreach ($playlist_ids as $id){
            $playlists[] = $api->getPlaylist($id);
        }

        return view('game.select-playlist',['playlists' => $playlists]);
    }

    public function putPlaylistFromImages($id)
    {
        User::where('id',Auth::user()->id)->update([
            'currentPlaylist' => $id,
        ]);

        return redirect()->route('game');
    }
}
