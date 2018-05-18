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

    public function index()
    {
        $stations = DB::table('stations')->where("userid", "=", Auth::id())->get();
        return view('auth.mystations', compact("stations"));
    }
}
