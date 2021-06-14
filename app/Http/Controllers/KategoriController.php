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
}
