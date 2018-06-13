<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loc = geoip()->getLocation('83.215.168.167');
        $lat = $loc->lat;
        $long = $loc->lon;

        $stations = DB::table('stations')->select(
            DB::raw('*, SQRT(POW(stations.lat - '.$lat.', 2) + POW(stations.long - '.$long.', 2)) AS distance'))
            ->orderBy('distance', 'asc')->limit(10)->get();

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

        return view('home', compact("stations"));
    }
}
