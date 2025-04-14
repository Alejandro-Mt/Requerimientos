<?php

namespace App\Http\Controllers;
use App\Models\estatu;
use App\Models\registro;
use App\Models\responsable;
use App\Models\sistema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaquetadoController extends Controller
{
    //
    protected function index(){
        $clientes = db::table('clientes')->orderby('id_cliente', 'asc')->get();
        $estatus = estatu::all();
        $registros = registro::where('folio', 'like', 'AA%')->count();
        $responsable = responsable::orderby('apellidos', 'asc')->get();
        $sistema = sistema::all();
        $vacio = registro:: select('*')->count();
        
        return view('formatos.maquetado.new',compact('sistema','responsable','registros','estatus','vacio','clientes'));
        #dd($registros);
        
    }

    protected function create(request $data){
        $registros = registro::where('folio', 'like', 'AA%')->count();
        $registros = $registros + 1;
        $folio = $data['folio'];
        $folio = "$folio-$registros";
        registro::create([
            'folio' => $folio,
            'descripcion' => $data['descripcion'],
            'id_responsable' => $data['id_responsable'],
            'id_sistema' => $data['id_sistema'],
            'id_cliente' => $data['id_cliente'],
            'id_estatus' => $data['id_estatus'],
            'id_area' => $data['id_area']
        ]);
    return redirect(route('NuevaMaqueta'))->with('alert', $folio);
    #return ($folio);
    }
}
