<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Models\registro;
use App\Models\responsable;
use App\Models\sistema;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;

class MenuController extends Controller
{
   
    /*public function create()
    {
        return view('formatos.requerimientos.new');
    }*/

    public function index()
    {
        #$sistema = \DB::table('sistema')->select('id_sistema','nombre_s')->get();
        #$ejecutivo = \DB::table('responsables')->select('id_responsable','nombre_r')->get();
        $sistema = sistema::all();
        $responsable = responsable::all();
        $cliente = cliente::orderby('id_cliente', 'asc') -> get();
        $registro = registro::all();
        return view('formatos.requerimientos.new',compact('sistema','responsable','cliente','registro'));
        #return view('formatos.requerimientos.new',compact('sistema'));
    }

    public function edit()
    {
        return view('formatos.requerimientos.edit');
    }

}
