<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Models\registro;
use App\Models\responsable;
use Illuminate\Http\Request;
use App\Models\sistema;
use Illuminate\Support\Facades\Validator;

class RecordController extends Controller
{
    protected function index(){
        $idreg = registro::orderby('id_registro','desc') -> take (1) -> get();
        $sistema = sistema::all();
        $responsable = responsable::all();
        $cliente = cliente::orderby('id_cliente', 'asc') -> get();
        return view('formatos.requerimientos.new',compact('sistema','responsable','cliente','idreg'));
    }

    protected function levantamiento(){
        $idreg = registro::orderby('id_registro','desc') -> take (1) -> get();
        $sistema = sistema::all();
        $responsable = responsable::all();
        $cliente = cliente::orderby('id_cliente', 'asc') -> get();
        return view('formatos.requerimientos.levantamiento',compact('sistema','responsable','cliente','idreg'));
    }

    /*public function __construct()
    {
        $this->middleware('auth');
    }

protected function validator(array $data)
    {
        return Validator::make($data, [
            'descripcion' => ['required', 'string', 'max:255'],
            'id_responsable' => ['required', 'string', 'max:255'],
            'id_sistema' => ['required', 'string', 'max:255'],
            'id_cliente' => ['required', 'string', 'max:255'],
        ]);
    }*/

    protected function create(request $data){
        registro::create([
        'bitrix' => $data['bitrix'],
        'descripcion' => $data['descripcion'],
        'id_responsable' => $data['id_responsable'],
        'id_sistema' => $data['id_sistema'],
        'id_cliente' => $data['id_cliente'],
        'estatus' => $data['estatus']
    ]);
        $idreg = registro::orderby('id_registro','desc') -> take (1) -> get();
        $sistema = sistema::all();
        $responsable = responsable::all();
        $cliente = cliente::orderby('id_cliente', 'asc') -> get();
        return view('formatos.requerimientos.new',compact('sistema','responsable','cliente','idreg'));
    }
}
