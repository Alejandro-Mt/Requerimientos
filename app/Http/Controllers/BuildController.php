<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\analisis;
use App\Models\cliente;
use App\Models\construccion;
use App\Models\desfase;
use App\Models\planeacion;
use App\Models\registro;
use App\Models\responsable;
use App\Models\sistema;

class BuildController extends Controller
{
    protected function planeacion($folio){
        $registros = registro::select('folio', 'id_estatus')->where('folio',$folio)->get();
        $id = registro::latest('id_registro')->first();
        $desfases = desfase::all();
        $previo = planeacion::select('*')->where('folio',$folio)->get();
        $vacio = planeacion:: select('*')->where('folio',$folio)->count();
        return view('formatos.requerimientos.planeacion',compact('registros','id','desfases','previo','vacio'));
        dd($previo);
    }
    protected function plan(request $data){
        $verificar = planeacion::where('folio',$data['folio'])->count();
        if($verificar == 0){
            planeacion::create([
            'folio' => $data['folio'],
            'fechaCompReqC' => date("y/m/d", strtotime($data['fechaCompReqC'])),
            'evidencia' => $data['evidencia'],
            'fechaCompReqR' => date("y/m/d", strtotime($data['fechaCompReqR'])),
            'desfase' => $data['desfase'],
            'motivodesfase' => $data['motivodesfase'],
            'motivopausa' => $data['motivopausa'],
            'evpausa' => $data['evpausa'],
            'fechareact' => date("y/m/d", strtotime($data['fechareact'])),
            ]);
        }
        else{
            $update = planeacion::select('*')->where('folio',$data['folio'])->first();
            $update->fechaCompReqC = date("y/m/d", strtotime($data['fechaCompReqC']));
            $update->evidencia = $data['evidencia'];
            $update->fechaCompReqR = date("y/m/d", strtotime($data['fechaCompReqR']));
            $update->desfase = $data['desfase'];
            $update->motivodesfase = $data['motivodesfase'];
            $update->motivopausa = $data['motivopausa'];
            $update->evpausa = $data['evpausa'];
            $update->fechareact = date("y/m/d", strtotime($data['fechareact']));
            $estatus = registro::select()-> where ('folio', $data->folio)->first();
            $estatus->id_estatus = $data['id_estatus'];
            $estatus->save();
            $update->save(); 
        }
        #$update = registro::select()-> where ('folio', $data->folio)->first();
        #$update->id_estatus = $data->input('id_estatus');
        #$update->save();
        return redirect(route('Editar'));
        dd($verificar);
    }

    protected function analisis($folio){
        $registros = registro::select('folio', 'id_estatus')->where('folio',$folio)->get();
        $id = registro::latest('id_registro')->first();
        $desfases = desfase::all();
        $previo = analisis::select('*')->where('folio',$folio)->get();
        $vacio = analisis:: select('*')->where('folio',$folio)->count();
        return view('formatos.requerimientos.analisis',compact('registros','id','desfases','previo','vacio'));
        dd($previo);
    }
    protected function propuesta(request $data){
        $verificar = analisis::where('folio',$data['folio'])->count();
        if($verificar == 0){
            analisis::create([
            'folio' => $data['folio'],
            'fechaCompReqC' => date("y/m/d", strtotime($data['fechaCompReqC'])),
            'evidencia' => $data['evidencia'],
            'fechaCompReqR' => date("y/m/d", strtotime($data['fechaCompReqR'])),
            'desfase' => $data['desfase'],
            'motivodesfase' => $data['motivodesfase'],
            'motivopausa' => $data['motivopausa'],
            'evpausa' => $data['evpausa'],
            'fechareact' => date("y/m/d", strtotime($data['fechareact'])),
            ]);
        }
        else{
            $update = analisis::select('*')->where('folio',$data['folio'])->first();
            $update->fechaCompReqC = date("y/m/d", strtotime($data['fechaCompReqC']));
            $update->evidencia = $data['evidencia'];
            $update->fechaCompReqR = date("y/m/d", strtotime($data['fechaCompReqR']));
            $update->desfase = $data['desfase'];
            $update->motivodesfase = $data['motivodesfase'];
            $update->motivopausa = $data['motivopausa'];
            $update->evpausa = $data['evpausa'];
            $update->fechareact = date("y/m/d", strtotime($data['fechareact']));
            $estatus = registro::select()-> where ('folio', $data->folio)->first();
            $estatus->id_estatus = $data['id_estatus'];
            $estatus->save();
            $update->save(); 
        }
        #$update = registro::select()-> where ('folio', $data->folio)->first();
        #$update->id_estatus = $data->input('id_estatus');
        #$update->save();
        return redirect(route('Editar'));

    }

    protected function construccion($folio){
        $registros = registro::select('folio', 'id_estatus')->where('folio',$folio)->get();
        $id = registro::latest('id_registro')->first();
        $desfases = desfase::all();
        $previo = construccion::select('*')->where('folio',$folio)->get();
        $vacio = construccion:: select('*')->where('folio',$folio)->count();
        return view('formatos.requerimientos.construccion',compact('registros','id','desfases','previo','vacio'));
        dd($previo);
    }

    protected function Construir(request $data){
        $verificar = construccion::where('folio',$data['folio'])->count();
        if($verificar == 0){
            construccion::create([
            'folio' => $data['folio'],
            'fechaCompReqC' => date("y/m/d", strtotime($data['fechaCompReqC'])),
            'evidencia' => $data['evidencia'],
            'fechaCompReqR' => date("y/m/d", strtotime($data['fechaCompReqR'])),
            'desfase' => $data['desfase'],
            'motivodesfase' => $data['motivodesfase'],
            'motivopausa' => $data['motivopausa'],
            'evpausa' => $data['evpausa'],
            'fechareact' => date("y/m/d", strtotime($data['fechareact'])),
            ]);
        }
        else{
            $update = construccion::select('*')->where('folio',$data['folio'])->first();
            $update->fechaCompReqC = date("y/m/d", strtotime($data['fechaCompReqC']));
            $update->evidencia = $data['evidencia'];
            $update->fechaCompReqR = date("y/m/d", strtotime($data['fechaCompReqR']));
            $update->desfase = $data['desfase'];
            $update->motivodesfase = $data['motivodesfase'];
            $update->motivopausa = $data['motivopausa'];
            $update->evpausa = $data['evpausa'];
            $update->fechareact = date("y/m/d", strtotime($data['fechareact']));
            $estatus = registro::select()-> where ('folio', $data->folio)->first();
            $estatus->id_estatus = $data['id_estatus'];
            $estatus->save();
            $update->save(); 
        }
        #$update = registro::select()-> where ('folio', $data->folio)->first();
        #$update->id_estatus = $data->input('id_estatus');
        #$update->save();
        return redirect(route('Editar'));

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
