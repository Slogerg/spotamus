<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use SpotifyWebAPI;


class GameController extends Controller
{
    private $spotifyApi;
    private $spotifyClient;
    private $spotifyChart;
//    private $user;

//    public function __construct()
//    {
//
//    }

    private function initial()
    {
        if(!is_null(Auth::user()) && !is_null(Auth::user()->currentPlaylist)){
            $playlist_id = Auth::user()->currentPlaylist;
        }
        else
            $playlist_id = "4OSIkmIjmBFz5monq4GqVj";

        // Attempt to get access token
        if (!Cache::has('accessToken')) {
            // Create the Spotify Client
            $this->spotifyClient = new SpotifyWebAPI\Session(
                Config::get('spotify.login'),
                Config::get('spotify.secret')
            );

            // Attempt to get client_credentials token
            if ($this->spotifyClient->requestCredentialsToken()) {
                $tokenExpiryMinutes = floor(($this->spotifyClient->getTokenExpiration() - time()) / 60);

                Cache::put(
                    'accessToken',
                    $this->spotifyClient->getAccessToken(),
                    $tokenExpiryMinutes
                );
            }
        }

        // Use access token to connect to API
        $this->spotifyApi = new SpotifyWebAPI\SpotifyWebAPI();
        $this->spotifyApi->setAccessToken(Cache::get('accessToken'));

        // Get the current UK Top 50
        if (!Cache::has('playlist')) {

            Cache::put(
                'playlist',
                $this->spotifyApi->getPlaylistTracks($playlist_id),
                2
            );
        }
    }

    /**
     * Show the form with the playing song and the three guess inputs
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->initial();

        $this->spotifyChart = Cache::get('playlist');
        // Get our session ofx recently used tracks
        $recents = (session('recents') ?: collect());
        // Run some filters over the track list
        $tracks = collect($this->spotifyChart->items)->reject(function($track) use ($recents) {
            // Reject the track if it doesn't have a preview URL
            // or it appears in the recents list
            return $this->_trackHasNoPreview($track->track)
                || $this->_trackIsRecent($track->track->id);
        })->shuffle()->take(3);
        // The first track is the correct answer

        $correct_track = $tracks->first();
        if(empty($correct_track->track))
            return redirect()->route('endtest');

        $correct_answer = $correct_track->track->id;

        // Add this to the "recently used" session
        $recents = $recents->push($correct_answer);

        // Make sure we only store the last 20
        if ($recents->count() >= 20) {
            $recents = $recents->slice(1,20)->values();
        }

        // Store it back in the session
        session([
            'recents' => $recents
        ]);

        // Shuffle the tracks for the form
        $answers = $tracks->shuffle();

        // The first answer is the correct one
        session(['answer' => $correct_answer]);

        // Show the form
        $form = View::make('game.form',[
            'answers' => $answers,
            'last_score' => session('last_score') ?: '',
            'track' => $correct_track->track,
            'update' => session('update') ?: '',
        ]);

        // Update the songs heard counter
        if (Auth::check()) {
            Auth::user()->increment('songs_seen');
        }

        return response($form);
    }

    /**
     * Handle a timeout
     */
    public function timeout()
    {
        $this->initial();
        // Redirect back
        return redirect()->route('game')->with([
            'update' => 'Timeout',
        ]);
    }

    /**
     * Test to see if a track has a valid preview URL
     *
     * @param $track
     * @return bool
     */
    private function _trackHasNoPreview($track)
    {
        $this->initial();

        return empty($track->preview_url);
    }

    /**
     * Test to see if a track has been recently used as a correct answer
     *
     * @param $track_id
     * @return bool
     */
    private function _trackIsRecent($track_id)
    {
        $this->initial();


        $recents = (session('recents') ?: collect());
        return $recents->contains($track_id);
    }

//    public function putPlaylist(Request $request)
//    {
////        Playlist::insert(['code' => $request->playlist,'created_at' => Carbon::now()]);
//        session(['playlist' => $request->playlist]);
//        return redirect()->route('home');
//    }
}
