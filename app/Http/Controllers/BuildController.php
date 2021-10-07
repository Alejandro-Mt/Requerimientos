<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\analisis;
use App\Models\cliente;
use App\Models\construccion;
use App\Models\desfase;
use App\Models\implementacion;
use App\Models\liberacion;
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
    
    protected function liberacion($folio){
        $desfases = desfase::all();
        $id = registro::latest('id_registro')->first();
        $previo = construccion::select('*')->where('folio',$folio)->get();
        $registros = registro::select('folio', 'id_estatus')->where('folio',$folio)->get();
        $vacio = construccion:: select('*')->where('folio',$folio)->count();
        return view('formatos.requerimientos.liberacion',compact('desfases','id','previo','registros','vacio'));
    }

    protected function liberar(request $data){
        $verificar = liberacion::where('folio',$data['folio'])->count();
        if($verificar == 0){
            liberacion::create([
                'folio' => $data['folio'],
                'fecha_lib_a' => date("y/m/d", strtotime($data['fecha_lib_a'])),
                'fecha_lib_r' => date("y/m/d", strtotime($data['fecha_lib_r'])),
                'inicio_lib' => date("y/m/d", strtotime($data['inicio_lib'])),
                'inicio_p_r' => date("y/m/d", strtotime($data['inicio_p_r'])),
                't_pruebas' => $data['t_pruebas'],
                'evidencia_p' => $data['evidencia_p'],
            ]);
        }
        else{
            $update = liberacion::select('*')->where('folio',$data['folio'])->first();
            $update->fecha_lib_a = date("y/m/d", strtotime($data['fecha_lib_a']));
            $update->fecha_lib_r = date("y/m/d", strtotime($data['fecha_lib_r']));
            $update->inicio_lib = date("y/m/d", strtotime($data['inicio_lib']));
            $update->inicio_p_r = date("y/m/d", strtotime($data['inicio_p_r']));
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
        $previo = construccion::select('*')->where('folio',$folio)->get();
        $registros = registro::select('folio', 'id_estatus')->where('folio',$folio)->get();
        $vacio = construccion:: select('*')->where('folio',$folio)->count();
        return view('formatos.requerimientos.implementacion',compact('desfases','id','previo','registros','vacio'));
    }

    protected function implementar(request $data){
        $verificar = implementacion::where('folio',$data['folio'])->count();
        if($verificar == 0){
            implementacion::create([
                'folio' => $data['folio'],
                'cronograma' => $data['cronograma'],
                'link_c' => $data['link_c'],
                'f_implementacion' => date("y/m/d", strtotime($data['f_implementacion'])),
                'estatus_f' => $data['estatus_f'],
                'seguimiento' => $data['seguimiento'],
                'comentarios' => $data['comentarios'],
            ]);
        }
        else{
            $update = implementacion::select('*')->where('folio',$data['folio'])->first();
            $update->cronograma = $data['cronograma'];
            $update->link_c = $data['link_c'];
            $update->f_implementacion = date("y/m/d", strtotime($data['f_implementacion']));
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

    protected function informacion($folio){
        $desfases = desfase::all();
        $id = registro::latest('id_registro')->first();
        $previo = construccion::select('*')->where('folio',$folio)->get();
        $registros = registro::select('folio', 'id_estatus')->where('folio',$folio)->get();
        $vacio = construccion:: select('*')->where('folio',$folio)->count();
        return view('formatos.requerimientos.informacion',compact('desfases','id','previo','registros','vacio'));
    }

    protected function SolInfo(request $data){
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
}
