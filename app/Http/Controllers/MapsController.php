<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Map;
use App\Kategory;
use Session;

class MapsController extends Controller
{
    public function index()
    {
        $maps = Map::paginate(25);

        return view('maps.index', compact('maps'));
    }


    public function create()
    {
    	$data = Kategory::get();
    	
    	return view('maps.create', compact('data'));
    }
}
