<?php

namespace App\Http\Controllers;

use App\Models\area;
use App\Models\departamento;
use App\Models\levantamiento;
use App\Models\registro;
use App\Models\responsable;
use App\Models\sistema;
use Illuminate\Http\Request;

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
        $registros = registro::select('folio')-> where ('id_registro', $id_registro)->get();
        $responsables = responsable::orderby('apellidos', 'asc')->get();
        $sistemas = sistema::all();
        return view('formatos/requerimientos/formato',compact('sistemas','responsables','registros','departamentos','areas')); 
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    protected function levantamiento(request $data){
        $this->validate($data, [
            'problema' => "max:250",
            'general' => "max:250",
            'detalle' => "max:250"
        ]);
        levantamiento::create([
            'folio' => $data['folio'],
            'solicitante' => $data['solicitante'],
            'departamento' => $data['departamento'],
            #'jefe_departamento' => $data['jefe_departamento'],
            'autorizacion' => $data['autorizacion'],
            'previo' => $data['previo'],
            'problema' => $data['problema'],
            'impacto' => $data['impacto'],
            'general' => $data['general'],
            'detalle' => $data['detalle'],
            'relaciones' => implode(',', $data['relaciones']),
            'areas' => implode(',', $data['areas']),
            'esperado' => $data['esperado'],
            'involucrados'=> implode(',', $data['involucrados'])
        ]);
        $estatus = registro::select()->where('folio', $data->folio)->first();
        $estatus->id_estatus = $data['id_estatus'];
        $estatus->save();  
        return redirect(route('Editar'));
        dd($data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    protected function actualiza(request $data){
        $update = levantamiento::FindOrFail($data['folio']);
        $update->solicitante = $data['solicitante'];
        $update->departamento = $data['departamento'];
        #$update->jefe_departamento = $data['jefe_departamento'];
        $update->autorizacion = $data['autorizacion'];
        $update->previo = $data['previo'];
        $update->problema = $data['problema'];
        $update->impacto = $data['impacto'];
        $update->general = $data['general'];
        $update->detalle = $data['detalle'];
        $update->relaciones = implode(',', $data['relaciones']);
        $update->areas = implode(',', $data['areas']);
        $update->esperado = $data['esperado'];
        $update->involucrados = implode(',', $data['involucrados']);
        $estatus = registro::select()-> where ('folio', $data->folio)->first();
        $estatus->id_estatus = $data['id_estatus'];
        $estatus->save();
        $update->save();  
        #dd($data);
        return redirect(route('Editar'));

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
        $registros = registro::select('folio')-> where ('id_registro', $id_registro)->get();
        $sistemas = sistema::all();
        $responsables = responsable::orderby('apellidos', 'asc')->get();
        $levantamientos = levantamiento::findOrFail($registros);
        $departamentos = departamento::all();
        $areas = area::all();
        foreach($levantamientos as $valor);
        $involucrados = explode(',',$valor->involucrados);
        $relaciones = explode(',',$valor->relaciones);
        $areasr = explode(',',$valor->areas);
        return view('formatos/requerimientos/levantamiento',compact('sistemas','responsables','relaciones','registros','levantamientos','involucrados','departamentos','areasr','areas'));
        #dd($relaciones);
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
