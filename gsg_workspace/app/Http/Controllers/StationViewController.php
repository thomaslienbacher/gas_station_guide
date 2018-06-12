<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StationViewController extends Controller
{
    public function index(Request $request)
    {
        if($request->input('todo') == "update") {
            DB::table('comments')->insert(
                ["userid" => Auth::id(), "stationid" => $request->input('stationid'),
                    'comment' => $request->input('commenttext'), 'stars' => $request->input('commentstars')]
            );
        }

        $station = DB::table('stations')->where("id", "=", $request->input('stationid'))->get()[0];
        $station->comments = DB::table('comments')->where("stationid", "=", $request->input('stationid'))->get();

        $station->stars = 0.0;
        $counter = 0.0;

        foreach ($station->comments as $comment) {
            $station->stars += $comment->stars;
            $counter += 1.0;
            $comment->user = DB::table('users')->where("id", "=", $comment->userid)->get()[0];
        }

        if($station->stars > 0) $station->stars /= $counter;

        $station->stars = round($station->stars, 1);

        return view('stationview', compact("station"));
    }
}
