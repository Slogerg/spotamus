<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index()
    {
        $leaderboard = User::orderBy('score','desc')
            ->orderBy('songs_correct','asc')
            ->get();

        return view('game.leaderboard',[
            'leaderboard' => $leaderboard,
        ]);
    }
}
