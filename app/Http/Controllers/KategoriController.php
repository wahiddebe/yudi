<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Kategory;

use Session;


class KategoriController extends Controller
{
     public function index()
    {
        $header = "Halaman Kategory";
        $header_description= "Index";
        $kategory = Kategory::paginate(25);

        return view('kategori.index', compact('kategory','header','header_description'));
    }

       public function create()
    {
       
        return view('kategori.create');
    }

      public function add(Request $request)
    {
        
        $requestData = $request->all();
        
        Kategory::create($requestData);

        Session::flash('flash_message', 'Kategori added!');

        return redirect(route('kategori'));
    }

    public function edit($id)
    {
        $kategori = Kategory::findOrFail($id);

        return view('kategori.edit', compact('kategori'));
    }

      public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $kategory = Kategory::findOrFail($id);
        $kategory->update($requestData);

        Session::flash('flash_message', 'Kategory updated!');

       return redirect(route('kategori'));
    }
}
