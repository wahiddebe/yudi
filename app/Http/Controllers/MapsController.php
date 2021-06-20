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

    public function add(Request $request)
    {
         $requestData = $request->all();
        
        Map::create($requestData);

        Session::flash('flash_message', 'Map added!');

        return redirect(route('maps'));
    }

    public function edit($id)
    {
        $map = Map::findOrFail($id);
        $kat= Kategory::where('id', $map->kategory_id)->first();
$data = Kategory::get();

        return view('maps.edit',compact('data','map','kat'));
    }

    public function update(Request $request, $id)
    {
           $requestData = $request->all();
        
        $map = Map::findOrFail($id);
        $map->update($requestData);

        Session::flash('flash_message', 'Map updated!');

          return redirect(route('maps'));
    }

      public function destroy($id)
    {
        Map::destroy($id);

        Session::flash('flash_message', 'Map deleted!');

      return redirect(route('maps'));
    }

}
