<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Models\estatu;
use App\Models\levantamiento;
use App\Models\registro;
use App\Models\responsable;
use App\Models\sistema;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    protected function index(){
        
        $registros = registro::where('folio', 'like', 'PIP%')->count();
        $sistema = sistema::all();
        $responsable = responsable::all();
        $cliente = cliente::orderby('id_cliente', 'asc') -> get();
        $id = registro::latest('id_registro')->first();
        $estatus = estatu::all();
        $vacio = registro:: select('*')->count();
        return view('formatos.requerimientos.new',compact('sistema','responsable','cliente','registros','id','estatus','vacio'));
        #dd($registros);
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
        'folio' => $data['folio'],
        'descripcion' => $data['descripcion'],
        'id_responsable' => $data['id_responsable'],
        'id_sistema' => $data['id_sistema'],
        'id_cliente' => $data['id_cliente'],
        'id_estatus' => $data['id_estatus'],
        'id_area' => $data['id_area']
    ]);
    return redirect(route('Nuevo'));
    #return ($data);
    }

    protected function edit($id_registro){
        $registros = registro::select('folio')-> where ('id_registro', $id_registro)->get();
        $sistemas = sistema::all();
        $responsables = responsable::all();
        $levantamientos = levantamiento::findOrFail($registros);
        foreach($levantamientos as $valor);
        $involucrados = explode(',',$valor->involucrados);
        $relaciones = explode(',',$valor->relaciones);
        return view('formatos/requerimientos/levantamiento',compact('sistemas','responsables','relaciones','registros','levantamientos','involucrados')); 
        #dd($relaciones);
    }
    
    protected function formato($id_registro){
        $registros = registro::select('folio')-> where ('id_registro', $id_registro)->get();
        $sistemas = sistema::all();
        $responsables = responsable::all();
        return view('formatos/requerimientos/formato',compact('sistemas','responsables','registros')); 
    }

    protected function levantamiento(request $data){
        levantamiento::create([
            'folio' => $data['folio'],
            'solicitante' => $data['solicitante'],
            'jefe_departamento' => $data['jefe_departamento'],
            'autorizacion' => $data['autorizacion'],
            'previo' => $data['previo'],
            'problema' => $data['problema'],
            'impacto' => $data['impacto'],
            'general' => $data['general'],
            'detalle' => $data['detalle'],
            'relaciones' => implode(',', $data['relaciones']),
            'esperado' => $data['esperado'],
            'involucrados'=> implode(',', $data['involucrados'])
        ]);
        $estatus = registro::select()->where('folio', $data->folio)->first();
        $estatus->id_estatus = $data['id_estatus'];
        $estatus->save();  
        return redirect(route('Editar'));
        dd($data);

    }

    protected function actualiza(request $data){
        $update = levantamiento::FindOrFail($data['folio']);
        $update->solicitante = $data['solicitante'];
        $update->jefe_departamento = $data['jefe_departamento'];
        $update->autorizacion = $data['autorizacion'];
        $update->previo = $data['previo'];
        $update->problema = $data['problema'];
        $update->impacto = $data['impacto'];
        $update->general = $data['general'];
        $update->detalle = $data['detalle'];
        $update->relaciones = implode(',', $data['relaciones']);
        $update->esperado = $data['esperado'];
        $update->involucrados = implode(',', $data['involucrados']);
        $estatus = registro::select()-> where ('folio', $data->folio)->first();
        $estatus->id_estatus = $data['id_estatus'];
        $estatus->save();
        $update->save();  
        #dd($data);
        return redirect(route('Editar'));

    }

}
