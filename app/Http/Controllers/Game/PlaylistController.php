<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
}
