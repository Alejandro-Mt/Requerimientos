<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Models\estatu;
use App\Models\levantamiento;
use App\Models\registro;
use App\Models\responsable;
use Illuminate\Http\Request;
use App\Models\sistema;

class RecordController extends Controller
{
    protected function index(){
        $registros = registro::orderby('id_registro','desc') -> limit(1) -> get();
        $sistema = sistema::all();
        $responsable = responsable::all();
        $cliente = cliente::orderby('id_cliente', 'asc') -> get();
        $id = registro::latest('id_registro')->first();
        $estatus = estatu::all();
        return view('formatos.requerimientos.new',compact('sistema','responsable','cliente','registros','id','estatus'));
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
        'id_estatus' => $data['id_estatus']
    ]);
    return redirect(route('Nuevo'));
    }

    protected function edit($id_registro){
        $registros = registro::select('folio')-> where ('id_registro', $id_registro)->get();
        $sistemas = sistema::all();
        $responsables = responsable::all();
        $levantamientos = levantamiento::findOrFail($registros);
        return view('formatos/requerimientos/levantamiento',compact('sistemas','responsables','registros','levantamientos')); 
        //dd($levantamientos);
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
            'relaciones' => $data['relaciones'],
            'esperado' => $data['esperado'],
            'involucrados'=> $data['involucrados']
        ]);
        $test = registro::select()-> where ('folio', $data->folio)->first();
        $test->id_estatus = $data->input('id_estatus');
        $test->save();  
        return redirect(route('Editar'));

    }

    protected function actualiza(request $data){
        $update = levantamiento::FindOrFail($data['folio']);
        $update->solicitante = $data->input('solicitante');
        $update->jefe_departamento = $data->input('jefe_departamento');
        $update->autorizacion = $data->input('autorizacion');
        $update->previo = $data->input('previo');
        $update->problema = $data->input('problema');
        $update->impacto = $data->input('impacto');
        $update->general = $data->input('general');
        $update->detalle = $data->input('detalle');
        $update->relaciones = $data->input('relaciones');
        $update->esperado = $data->input('esperado');
        $update->involucrados = $data->input('involucrados');
        $estatus = registro::select()-> where ('folio', $data->folio)->first();
        $estatus->id_estatus = $data->input('id_estatus');
        $estatus->save();
        $update->save();  
        //dd($update);
        return redirect(route('Editar'));

    }
}
