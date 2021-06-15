<?php

namespace App\Http\Controllers;

use App\Models\sistema;
use Illuminate\Http\Request;

class MenuController extends Controller
{
   
    /*public function create()
    {
        return view('formatos.requerimientos.new');
    }*/

    public function index()
    {
        #$sistema = \DB::table('sistema')->select('id_sistema','nombre_s')->get();
        $sistema = sistema::all();
        return view('formatos.requerimientos.new',compact('sistema'));
    }

}
