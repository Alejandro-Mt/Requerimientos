<?php

namespace App\Http\Controllers;

use App\Mail\ValidacionCliente;
use App\Models\registro;
use Illuminate\Support\Facades\Mail;

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

    public function send(){
        
        return view('Layouts/correo');
    }
    public function sended(){
        //mail::to('alexgarzia9@gmail.com')->send(new ValidacionCliente);
        //return 'Correo Enviado';
        dd()->all();
    }
}
