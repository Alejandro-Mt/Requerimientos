<?php

namespace App\Http\Controllers;

use App\Models\analisis;
use App\Models\desfase;
use App\Models\informacion;
use App\Models\planeacion;
use App\Models\registro;
use Illuminate\Http\Request;

class AnalisisController extends Controller
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
        $previo = analisis::select('*')->where('folio',$folio)->get();
        $vacio = analisis:: select('*')->where('folio',$folio)->count();
        $solinf = informacion::where('folio',$folio)->whereNULL('respuesta')->count();
        return view('formatos.requerimientos.analisis',compact('registros','id','desfases','previo','vacio','solinf'));
        #dd($solinf);
        #dd($previo);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $data){
        $val = planeacion::select('fechaCompReqR')->where('folio',$data['folio'])->get();
        if($data['desfase'] == '1'){
            $this->validate($data, ['motivodesfase' => "required"]);
            $this->validate($data, ['fechareact' => "required|date|after_or_equal:$data[fechaCompReqC]"]);
        }
        foreach($val as $fecha){$this->validate($data, ['fechaCompReqC' => "required|date|after_or_equal:$fecha->fechaCompReqR"]);}
        $verificar = analisis::where('folio',$data['folio'])->count();
        if($data['fechaCompReqC']<>NULL){$fechaCompReqC=date("y/m/d", strtotime($data['fechaCompReqC']));}else{$fechaCompReqC=NULL;}
        if($data['fechaCompReqR']<>NULL){
            if($data['fechaCompReqC'] <> NULL){
                $this->validate($data, ['fechaCompReqR' => "required|date|after_or_equal:$data[fechaCompReqC]"]);
            }
            $fechaCompReqR=date("y/m/d", strtotime($data['fechaCompReqR']));}
        else{
            $fechaCompReqR=NULL;
        }
        if($data['fechareact']<>NULL){$fechareact=date("y/m/d", strtotime($data['fechareact']));}else{$fechareact=NULL;}
        if($data['id_estatus'] == 7){$this->validate($data, ['fechaCompReqR' => "required|date|after_or_equal:$data[fechaCompReqC]"]);}
        if($verificar == 0){
            analisis::create([
            'folio' => $data['folio'],
            'fechaCompReqC' =>$fechaCompReqC,
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
            $update = analisis::select('*')->where('folio',$data['folio'])->first();
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
        #dd($fechareact);
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
