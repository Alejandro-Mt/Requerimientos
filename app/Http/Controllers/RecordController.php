<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Models\levantamiento;
use App\Models\registro;
use App\Models\responsable;
use Illuminate\Http\Request;
use App\Models\sistema;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Support\Facades\Validator;

class RecordController extends Controller
{
    protected function index(){
        $registros = registro::orderby('id_registro','desc') -> limit(1) -> get();
        $sistema = sistema::all();
        $responsable = responsable::all();
        $cliente = cliente::orderby('id_cliente', 'asc') -> get();
        $id = registro::latest('id_registro')->first();
        return view('formatos.requerimientos.new',compact('sistema','responsable','cliente','registros','id'));
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
    return redirect(route('Nuevo'));
    }
    
    protected function edit($id_registro){
        $registros = registro::select('bitrix')-> where ('id_registro', $id_registro)->get();
        $sistemas = sistema::all();
        $responsables = responsable::all();
        return view('formatos/requerimientos/levantamiento',compact('sistemas','responsables','registros')); 
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
        $test = registro::select('id_registro')-> where ('bitrix', $data->folio)->first();
        $test->estatus = $data->input('estatus');
        $test->save();  
        return redirect('Editar');

    }
}
