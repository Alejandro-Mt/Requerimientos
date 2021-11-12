<?php

namespace App\Http\Controllers;

use App\Models\construccion;
use App\Models\desfase;
use App\Models\registro;
use App\Models\informacion;
use Illuminate\Http\Request;

class ConstruccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($folio){
        $registros = registro::select('folio', 'id_estatus')->where('folio',$folio)->get();
        $id = registro::latest('id_registro')->first();
        $desfases = desfase::all();
        $previo = construccion::select('*')->where('folio',$folio)->get();
        $vacio = construccion:: select('*')->where('folio',$folio)->count();
        $solinf = informacion::where('folio',$folio)->whereNULL('respuesta')->count();
        return view('formatos.requerimientos.construccion',compact('registros','id','desfases','previo','vacio','solinf'));
        dd($previo);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $data){
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
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
