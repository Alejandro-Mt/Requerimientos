<?php

namespace App\Http\Controllers;

use App\Mail\Interno\NuevoProyecto;
use App\Models\area;
use App\Models\departamento;
use App\Models\division;
use App\Models\levantamiento;
use App\Models\registro;
use App\Models\responsable;
use App\Models\sistema;
use App\Models\solicitante;
use App\Models\solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class LevantamientosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    protected function formato($id_registro){
        $areas = area::all();
        $departamentos = departamento::all();
        $registros = registro::select('folio')-> where ('id_registro', Crypt::decrypt($id_registro))->first();
        $responsables = responsable::orderby('apellidos', 'asc')->get();
        $sistemas = sistema::all();
        $solicitantes = solicitante::all();
        $solicitud = solicitud::leftJoin('solicitantes as sol', 'sol.email', '=', 'solicitudes.correo')
            ->leftJoin('division as d', 'd.id_division', '=', 'sol.id_division')
            ->where('folior', $registros->folio)
            ->first();
        return view('formatos/requerimientos/formato',compact('solicitud','solicitantes','sistemas','responsables','registros','departamentos','areas')); 
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    protected function levantamiento(request $data){
        $this->validate($data, [
            'problema' => "max:250"
        ]);
        $solicitante = solicitante::FindOrFail($data['id_solicitante']);
        $data['id_division'] = $solicitante->id_division;
        levantamiento::create([
            'folio' => $data['folio'],
            'solicitante' => $data['solicitante'],
            'departamento' => $data['departamento'],
            #'jefe_departamento' => $data['jefe_departamento'],
            'autorizacion' => $data['autorizacion'],
            'previo' => $data['previo'],
            'problema' => $data['problema'],
            'prioridad' => $data['impacto'],
            'general' => $data['general'],
            'detalle' => $data['detalle'],
            'relaciones' => implode(',', $data['relaciones']),
            'areas' => implode(',', $data['areas']),
            'esperado' => $data['esperado'],
            'involucrados'=> implode(',', $data['involucrados']),
            'id_solicitante' => $data['id_solicitante'],
            'id_division' => $data['id_division']
        ]);
        $destino = db::table('responsables')->wherein('id_responsable',$data['involucrados'])->get();
        $estatus = registro::where('folio', $data->folio)->first();
        $estatus->id_estatus = $data['id_estatus'];
        $estatus->save();  
        foreach ($destino as $correo) {
            if ($estatus->es_proyecto){
                mail::to($correo->email)->send(new NuevoProyecto($data,$correo->nombre_r));
            }
        }
        return redirect(route('Documentos',Crypt::encrypt($data['folio'])));
        dd($data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    protected function actualiza(request $data){
        $solicitante = solicitante::FindOrFail($data['id_solicitante']);
        $data['id_division'] = $solicitante->id_division;
        $update = levantamiento::FindOrFail($data['folio']);
        $update->solicitante = $data['solicitante'];
        $update->departamento = $data['departamento'];
        #$update->jefe_departamento = $data['jefe_departamento'];
        $update->autorizacion = $data['autorizacion'];
        $update->previo = $data['previo'];
        $update->problema = $data['problema'];
        $update->prioridad = $data['impacto'];
        $update->general = $data['general'];
        $update->detalle = $data['detalle'];
        $update->relaciones = implode(',', $data['relaciones']);
        $update->areas = implode(',', $data['areas']);
        $update->esperado = $data['esperado'];
        $update->involucrados = implode(',', $data['involucrados']);
        $update->id_solicitante = $data['id_solicitante'];
        $update->id_division = $data['id_division'];
        $estatus = registro::select()-> where ('folio', $data->folio)->first();
        $estatus->id_estatus = $data['id_estatus'];
        $estatus->save();
        $update->save();  
        #dd($data);
        return redirect(route('Documentos',Crypt::encrypt($data['folio'])));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    protected function edit($id_registro){
        $registros = registro::select('folio')->where('id_registro', Crypt::decrypt($id_registro))->first();
        $sistemas = sistema::all();
        $responsables = responsable::orderby('apellidos', 'asc')->get();
        $levantamientos = levantamiento::findOrFail($registros);
        $departamentos = departamento::all();
        $areas = area::all();
        $solicitantes = solicitante::all();
        $solicitud = solicitud::leftJoin('solicitantes as sol', 'sol.email', '=', 'solicitudes.correo')
            ->leftJoin('division as d', 'd.id_division', '=', 'sol.id_division')
            ->where('folior', $registros->folio)
            ->first();
        foreach($levantamientos as $valor){
            $involucrados = explode(',',$valor->involucrados);
            $relaciones = explode(',',$valor->relaciones);
            $areasr = explode(',',$valor->areas);
        }
        return view('formatos/requerimientos/levantamiento',compact('solicitud','solicitantes','sistemas','responsables','relaciones','registros','levantamientos','involucrados','departamentos','areasr','areas'));
        dd($solicitud);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
