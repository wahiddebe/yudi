<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Map;
use App\Kategory;
use App\Setting;
use DB;

class RouteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */



    public function index()
    {
        $key = "AIzaSyCKJFEXq3qQejQLfIidVDlBzzdGgF82CHs";
        $data = Map::all();
        return view('route', compact('key', 'data'));
    }
}
