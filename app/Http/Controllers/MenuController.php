<?php

namespace App\Http\Controllers;
use App\Models\registro;

class MenuController extends Controller
{
   
    /*public function create()
    {
        return view('formatos.requerimientos.new');
    }*/


    public function edit()
    {
        $registros = registro::all();
        return view('formatos.requerimientos.edit',compact('registros'));
    }

}
