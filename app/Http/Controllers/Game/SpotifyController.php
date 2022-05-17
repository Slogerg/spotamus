<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use SpotifyWebAPI;
class SpotifyController extends Controller
{
    public function index()
    {

        $session = new SpotifyWebAPI\Session(
            Config::get('spotify.login'),
            Config::get('spotify.secret')
        );

        $session->requestCredentialsToken();
        $accessToken = $session->getAccessToken();
        $api = new SpotifyWebAPI\SpotifyWebAPI();
        $api->setAccessToken($accessToken);

//        dd(
//            $results = $api->search('gorillaz', 'artist')
//        );
        return view('search');
    }
}
