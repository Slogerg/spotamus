<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuessController extends Controller
{
    /**
     * Handle the user's guess
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Work out the number of points to add or subtract on this round
        $last_score = ceil((30 - $request->time) / 3);

        // Check to see if they got this one right
        if ($request->answer == session('answer')) {
//            dd('yes');
            // Update the database

            if (Auth::check()) {
                User::where('id',Auth::user()->id)->update([
                    'songs_correct' => \DB::raw('songs_correct + 1'),
                    'score' => \DB::raw('score + '.$last_score),
                ]);
            }

            $update = 'Right';
        } else {
            if (Auth::check()) {
                Auth::user()->decrement('score',$last_score);
            }

            $update = 'Wrong';
        }

        return redirect()->route('game')->with([
            'last_score' => $last_score,
            'update' => $update,
        ]);
    }
}
