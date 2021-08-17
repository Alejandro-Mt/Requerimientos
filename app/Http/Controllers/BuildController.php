<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\analisis;
use App\Models\cliente;
use App\Models\desface;
use App\Models\planeacion;
use App\Models\registro;
use App\Models\responsable;
use App\Models\sistema;

class BuildController extends Controller
{
    protected function planeacion($folio){
        $registros = registro::select('folio', 'id_estatus')->where('folio',$folio)->get();
        $id = registro::latest('id_registro')->first();
        $desfaces = desface::all();
        return view('formatos.requerimientos.planeacion',compact('registros','id','desfaces'));
    }
    protected function plan(request $data){
        planeacion::create([
        'folio' => $data['folio'],
        'fechaCompReqC' => $data['fechaCompReqC'],
        'evidencia' => $data['evidencia'],
        'fechaCompReqR' => $data['fechaCompReqR'],
        'desface' => $data['desface'],
        'motivodesface' => $data['motivodesface'],
        'motivopausa' => $data['motivopausa'],
        'evpausa' => $data['evpausa'],
        'fechareact' => $data['fechareact'],
        ]);
        $update = registro::select()-> where ('folio', $data->folio)->first();
        $update->id_estatus = $data->input('id_estatus');
        $update->save();
        return redirect(route('Editar'));
        #dd($update);
    }

    protected function analisis($folio){
        $registros = registro::select('folio', 'id_estatus')->where('folio',$folio)->get();
        $id = registro::latest('id_registro')->first();
        $desfaces = desface::all();
        return view('formatos.requerimientos.analisis',compact('desfaces','id','registros'));
    }
    protected function propuesta(request $data){
        analisis::create([
            'folio' => $data['folio'],
            'fechaEnvAnC' => $data['fechaEnvAnC'],
            'retraso' => $data['retraso'],
            'motivoRet' => $data['motivoRet'],
            'fechaAutC' => $data['fechaAutC']
            ]);
            $update = registro::select()-> where ('folio', $data->folio)->first();
            $update->id_estatus = $data->input('id_estatus');
            $update->save();
            return redirect(route('Editar'));
            #dd($update);
    }

    protected function construccion(){
        $registros = registro::orderby('id_registro','desc') -> limit(1) -> get();
        $sistema = sistema::all();
        $responsable = responsable::all();
        $cliente = cliente::orderby('id_cliente', 'asc') -> get();
        $id = registro::latest('id_registro')->first();
        return view('formatos.requerimientos.construccion',compact('sistema','responsable','cliente','registros','id'));
    }
    protected function informacion(){
        $registros = registro::orderby('id_registro','desc') -> limit(1) -> get();
        $sistema = sistema::all();
        $responsable = responsable::all();
        $cliente = cliente::orderby('id_cliente', 'asc') -> get();
        $id = registro::latest('id_registro')->first();
        return view('formatos.requerimientos.informacion',compact('sistema','responsable','cliente','registros','id'));
    }
}
