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
use App\Models\User;
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
        $areas = area::orderby('area', 'asc')->get();
        $departamentos = departamento::orderby('departamento', 'asc')->get();
        $registros = registro::where('id_registro', Crypt::decrypt($id_registro))->first();
        $responsables = User::activos()->orderby('nombre', 'asc')->get();
        $sistemas = sistema::orderby('nombre_s', 'asc')->get();
        return view('formatos/requerimientos/formato',compact('sistemas','responsables','registros','departamentos','areas')); 
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
        $solicitante = User::FindOrFail($data['id_solicitante']);
        $data['id_division'] = $solicitante->usrdata->id_division;
        levantamiento::create([
            'folio' => $data['folio'],
            'solicitante' => $data['solicitante'],
            'departamento' => $data['departamento'],
            'autorizacion' => $data['autorizacion'],
            'previo' => $data['previo'],
            'problema' => $data['problema'],
            'prioridad' => $data['prioridad'],
            'general' => $data['general'],
            'detalle' => $data['detalle'],
            'relaciones' => implode(',', $data['relaciones']),
            'areas' => implode(',', $data['areas']),
            'esperado' => $data['esperado'],
            'involucrados'=> implode(',', $data['involucrados']),
            'id_solicitante' => $data['id_solicitante'],
            'id_division' => $data['id_division']
        ]);
        $destino = db::table('users')->wherein('id',$data['involucrados'])->get();
        $estatus = registro::where('folio', $data->folio)->first();
        $estatus->id_estatus = $data['id_estatus'];
        $estatus->save();  
        foreach ($destino as $correo) {
            if ($estatus->es_proyecto){
                mail::to($correo->email)->send(new NuevoProyecto($data,$correo->nombre));
            }
        }
        return redirect(route('Documentos',Crypt::encrypt($data['folio'])));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    protected function actualiza(request $data){
        $solicitante = User::FindOrFail($data['id_solicitante']);
        $data['id_division'] = $solicitante->usrdata->id_division;
        $update = levantamiento::FindOrFail($data['folio']);
        $update->solicitante = $data['solicitante'];
        $update->departamento = $data['departamento'];
        $update->autorizacion = $data['autorizacion'];
        $update->previo = $data['previo'];
        $update->problema = $data['problema'];
        $update->prioridad = $data['prioridad'];
        $update->general = $data['general'];
        $update->detalle = $data['detalle'];
        $update->relaciones = implode(',', $data['relaciones']);
        $update->areas = implode(',', $data['areas']);
        $update->esperado = $data['esperado'];
        $update->involucrados = implode(',', $data['involucrados']);
        $update->id_solicitante = $data['id_solicitante'];
        $update->id_division = $data['id_division'];
        $update->save(); 
        $estatus = registro::select()-> where ('folio', $data->folio)->first();
        $estatus->id_estatus = $data['id_estatus'];
        $estatus->save(); 
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
        $areas = area::all();
        $departamentos = departamento::all();
        $registros = registro::where('id_registro', Crypt::decrypt($id_registro))->first();
        $responsables = User::activos()->orderby('nombre', 'asc')->get();
        $sistemas = sistema::all();
        $levantamiento = levantamiento::findOrFail($registros->folio);
        $involucrados = explode(',',$levantamiento->involucrados);
        $relaciones = explode(',',$levantamiento->relaciones);
        $areasr = explode(',',$levantamiento->areas);
        return view('formatos/requerimientos/levantamiento',compact('sistemas','responsables','relaciones','registros','levantamiento','involucrados','departamentos','areasr','areas'));
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
