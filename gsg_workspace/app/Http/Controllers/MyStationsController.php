<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MyStationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->input('todo') == "add") {
            DB::table('stations')->insert(
                ["name" => $request->input('stationname'), "lat" => $request->input('stationlat'),
                    "long" => $request->input('stationlong'), "imageurl" => $request->input('stationimageurl'),
                    "description" => $request->input('stationdescription'), "userid" => Auth::id()]
            );
        }

        if($request->input('todo') == "update") {
            DB::table('stations')->where('id', $request->input('stationid'))
                ->update(
                ["name" => $request->input('stationname'), "lat" => $request->input('stationlat'),
                    "long" => $request->input('stationlong'), "imageurl" => $request->input('stationimageurl'),
                    "description" => $request->input('stationdescription'), "userid" => Auth::id()]
            );
        }

        $stations = DB::table('stations')->where("userid", "=", Auth::id())->get();

        return view('auth.mystations', compact("stations"));
    }
}
