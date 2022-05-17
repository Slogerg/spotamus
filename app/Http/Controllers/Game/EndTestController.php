<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EndTestController extends Controller
{
    public function index()
    {
        return view('game.endtest');
    }
}
