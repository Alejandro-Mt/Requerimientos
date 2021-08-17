<?php

namespace App\Http\Controllers;

use App\Mail\ValidacionCliente;
use App\Models\estatu;
use App\Models\registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\VarDumper\Cloner\Data;

class MenuController extends Controller
{
   
    /*public function create()
    {
        return view('formatos.requerimientos.new');
    }*/


    public function edit()
    {
        $titulos = registro::all();
        $estatus = registro::all();
        $registros = registro::select('*')->join('estatus','estatus.id_estatus', 'registros.id_estatus')->get();
        return view('formatos.requerimientos.edit',compact('estatus', 'titulos', 'registros'));
        #dd($titulos->all());
    }

    public function send($folio){
        $registros = registro::select('*')-> where ('folio', $folio)->get();
        return view('Layouts.correo',compact('registros'));
        #dd($registros);
    }
    public function sended(request $data){
        mail::to($data->email)->send(new ValidacionCliente);
        $estatus = registro::select("*")-> where ('folio', $data->folio)->first();
        $estatus->id_estatus = $data->input('id_estatus');
        $estatus->save();
        return redirect('formatos.requerimientos.edit');
        #dd($estatus);
    }
}
