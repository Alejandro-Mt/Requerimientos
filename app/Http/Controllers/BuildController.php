<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\construccion;
use App\Models\desfase;
use App\Models\implementacion;
use App\Models\liberacion;
use App\Models\registro;

class BuildController extends Controller
{

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
        if($data['fechaCompReqC']<>NULL){$fechaCompReqC=date("y/m/d", strtotime($data['fechaCompReqC']));}else{$fechaCompReqC=NULL;}
        if($data['fechaCompReqR']<>NULL){$fechaCompReqR=date("y/m/d", strtotime($data['fechaCompReqR']));}else{$fechaCompReqR=NULL;}
        if($data['fechareact']<>NULL){$fechareact=date("y/m/d", strtotime($data['fechareact']));}else{$fechareact=NULL;}
        if($verificar == 0){
            construccion::create([
            'folio' => $data['folio'],
            'fechaCompReqC' => $fechaCompReqC,
            'evidencia' => $data['evidencia'],
            'fechaCompReqR' => $fechaCompReqR,
            'desfase' => $data['desfase'],
            'motivodesfase' => $data['motivodesfase'],
            'motivopausa' => $data['motivopausa'],
            'evpausa' => $data['evpausa'],
            'fechareact' => $fechareact,
            ]);
        }
        else{
            $update = construccion::select('*')->where('folio',$data['folio'])->first();
            $update->fechaCompReqC = $fechaCompReqC;
            $update->evidencia = $data['evidencia'];
            $update->fechaCompReqR = $fechaCompReqR;
            $update->desfase = $data['desfase'];
            $update->motivodesfase = $data['motivodesfase'];
            $update->motivopausa = $data['motivopausa'];
            $update->evpausa = $data['evpausa'];
            $update->fechareact = $fechareact;
            $estatus = registro::select()-> where ('folio', $data->folio)->first();
            $estatus->id_estatus = $data['id_estatus'];
            $estatus->save();
            $update->save(); 
        }
        $update = registro::select()-> where ('folio', $data->folio)->first();
        $update->id_estatus = $data->input('id_estatus');
        $update->save();
        return redirect(route('Editar'));

    }
    
    protected function liberacion($folio){
        $desfases = desfase::all();
        $id = registro::latest('id_registro')->first();
        $previo = liberacion::select('*')->where('folio',$folio)->get();
        $registros = registro::select('folio', 'id_estatus')->where('folio',$folio)->get();
        $vacio = liberacion:: select('*')->where('folio',$folio)->count();
        return view('formatos.requerimientos.liberacion',compact('desfases','id','previo','registros','vacio'));
    }

    protected function liberar(request $data){
        $verificar = liberacion::where('folio',$data['folio'])->count();
        if($data['fecha_lib_a']<>NULL){$fecha_lib_a=date("y/m/d", strtotime($data['fecha_lib_a']));}else{$fecha_lib_a=NULL;}
        if($data['fecha_lib_r']<>NULL){$fecha_lib_r=date("y/m/d", strtotime($data['fecha_lib_r']));}else{$fecha_lib_r=NULL;}
        if($data['inicio_lib']<>NULL){$inicio_lib=date("y/m/d", strtotime($data['inicio_lib']));}else{$inicio_lib=NULL;}
        if($data['inicio_p_r']<>NULL){$inicio_p_r=date("y/m/d", strtotime($data['inicio_p_r']));}else{$inicio_p_r=NULL;}
        if($verificar == 0){
            liberacion::create([
                'folio' => $data['folio'],
                'fecha_lib_a' => $fecha_lib_a,
                'fecha_lib_r' => $fecha_lib_r,
                'inicio_lib' => $inicio_lib,
                'inicio_p_r' => $inicio_p_r,
                't_pruebas' => $data['t_pruebas'],
                'evidencia_p' => $data['evidencia_p'],
            ]);
        }
        else{
            $update = liberacion::select('*')->where('folio',$data['folio'])->first();
            $update->fecha_lib_a = $fecha_lib_a;
            $update->fecha_lib_r = $fecha_lib_r;
            $update->inicio_lib = $inicio_lib;
            $update->inicio_p_r = $inicio_p_r;
            $update->t_pruebas = $data['t_pruebas'];
            $update->evidencia_p = $data['evidencia_p'];
            $estatus = registro::select()-> where ('folio', $data->folio)->first();
            $estatus->id_estatus = $data['id_estatus'];
            $estatus->save();
            $update->save(); 
        }
        $update = registro::select()-> where ('folio', $data->folio)->first();
        $update->id_estatus = $data->input('id_estatus');
        $update->save();
        return redirect(route('Editar'));
        #dd($update);

    }

    protected function implementacion($folio){
        $desfases = desfase::all();
        $id = registro::latest('id_registro')->first();
        $previo = implementacion::select('*')->where('folio',$folio)->get();
        $registros = registro::select('folio', 'id_estatus')->where('folio',$folio)->get();
        $vacio = implementacion:: select('*')->where('folio',$folio)->count();
        return view('formatos.requerimientos.implementacion',compact('desfases','id','previo','registros','vacio'));
    }

    protected function implementar(request $data){
        $verificar = implementacion::where('folio',$data['folio'])->count();
        if($data['f_implementacion']<>NULL){$f_implementacion=date("y/m/d", strtotime($data['f_implementacion']));}else{$f_implementacion=NULL;}
        if($verificar == 0){
            implementacion::create([
                'folio' => $data['folio'],
                'cronograma' => $data['cronograma'],
                'link_c' => $data['link_c'],
                'f_implementacion' => $f_implementacion,
                'estatus_f' => $data['estatus_f'],
                'seguimiento' => $data['seguimiento'],
                'comentarios' => $data['comentarios'],
            ]);
        }
        else{
            $update = implementacion::select('*')->where('folio',$data['folio'])->first();
            $update->cronograma = $data['cronograma'];
            $update->link_c = $data['link_c'];
            $update->f_implementacion = $f_implementacion;
            $update->estatus_f = $data['estatus_f'];
            $update->seguimiento = $data['seguimiento'];
            $update->comentarios = $data['comentarios'];
            $estatus = registro::select()-> where ('folio', $data->folio)->first();
            $estatus->id_estatus = $data['id_estatus'];
            $estatus->save();
            $update->save(); 
        }
        $update = registro::select()-> where ('folio', $data->folio)->first();
        $update->id_estatus = $data->input('id_estatus');
        $update->save();
        return redirect(route('Editar'));
        #dd($update);

    }

}
