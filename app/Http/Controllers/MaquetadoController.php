<?php

namespace App\Http\Controllers;
use app\Models\cliente;
use App\Models\estatu;
use App\Models\registro;
use App\Models\responsable;
use App\Models\sistema;
use Illuminate\Http\Request;

class MaquetadoController extends Controller
{
    //
    protected function index(){
        $cliente = cliente::all();
        $estatus = estatu::all();
        $registros = registro::where('folio', 'like', 'AA%')->count();
        $responsable = responsable::all();
        $sistema = sistema::all();
        $vacio = registro:: select('*')->count();
        
        return view('formatos.maquetado.new',compact('sistema','responsable','registros','estatus','vacio','cliente'));
        #dd($registros);
        
    }

    protected function create(request $data){
        registro::create([
        'folio' => $data['folio'],
        'descripcion' => $data['descripcion'],
        'id_responsable' => $data['id_responsable'],
        'id_sistema' => $data['id_sistema'],
        'id_cliente' => $data['id_cliente'],
        'id_estatus' => $data['id_estatus'],
        'id_area' => $data['id_area']
    ]);
    return redirect(route('NuevaMaqueta'));
    }
}
