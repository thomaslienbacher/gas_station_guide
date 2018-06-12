<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $stations = array();

        if($request->input('todo') == "search") {
            $stations = DB::table('stations')->where("name", "like", "%" . $request->input('searchkeyword') . "%")->get();
        }

        foreach ($stations as $station) {
            $station->comments = DB::table('comments')->where("stationid", "=", $station->id)->get();

            $station->stars = 0.0;
            $counter = 0.0;

            foreach ($station->comments as $comment) {
                $station->stars += $comment->stars;
                $counter += 1.0;
            }

            if($station->stars > 0) $station->stars /= $counter;

            $station->stars = round($station->stars, 1);
        }

        return view('search', compact("stations"));
    }
}
