<?php

namespace App\Http\Controllers;

use App\Models\desfase;
use App\Models\informacion;
use App\Models\registro;
use Illuminate\Http\Request;


class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($folio)
    {
        //
        $desfases = desfase::all();
        $id = registro::latest('id_registro')->first();
        $previo = informacion::select('*')->where('folio',$folio)->get();
        $registros = registro::select('folio', 'id_estatus')->where('folio',$folio)->get();
        $vacio = informacion:: select('*')->where('folio',$folio)->count();
        #$info = informacion::raw('select');
        return view('formatos.requerimientos.informacion',compact('desfases','id','previo','registros','vacio'));
        #dd($id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $data)
    {
        $verificar = informacion::where('folio',$data['folio'])->count();
        if($verificar == 0){
            if($data['solInfopip']<>NULL){$solInfopip=date("y/m/d", strtotime($data['solInfopip']));}else{$solInfopip=NULL;}
            if($data['solInfoC']<>NULL){$solInfoC=date("y/m/d", strtotime($data['solInfoC']));}else{$solInfoC=NULL;}
            if($data['respuesta']<>NULL){$respuesta=date("y/m/d", strtotime($data['respuesta']));}else{$respuesta=NULL;}
            if($data['retraso']==NULL){$retraso = 0;}else{$retraso=$data['retraso'];}
            informacion::create([
            'folio' => $data['folio'],
            'solInfopip' =>  $solInfopip,
            'detalle' => $data['detalle'],
            'evidencia' => $data['evidencia'],
            'solInfoC' => $solInfoC,
            'retraso' => $retraso,
            'motivoRetrasoInfo' => $data['motivoRetrasoInfo'],
            'respuesta' => $respuesta,
            ]);
        }
        else{
            $update = informacion::select('*')->where('folio',$data['folio'])->first();
            if($data['solInfopip'] == null){$update->solInfopip = $data['solInfopip'];}
            else{$update->solInfopip = date("y/m/d", strtotime($data['solInfopip']));}
            #$update->evidencia = $data['evidencia'];
            if($data['solInfoC'] == null){$update->solInfoC = $data['solInfoC'];}
            else{$update->solInfoC = date("y/m/d", strtotime($data['solInfoC']));}
            if($data['retraso'] == null){$update->retraso = '0';}
            else{$update->retraso = $data['retraso'];}
            $update->motivoRetrasoInfo = $data['motivoRetrasoInfo'];
            if($data['respuesta'] == null){$update->respuesta = $data['respuesta'];}
            else{$update->respuesta = date("y/m/d", strtotime($data['respuesta']));}
            #$estatus = registro::select()-> where ('folio', $data->folio)->first();
            #$estatus->id_estatus = $data['id_estatus'];
            #$estatus->save();
            $update->save(); 
        }
        #$update = registro::select()-> where ('folio', $data->folio)->first();
        #$update->id_estatus = $data->input('id_estatus');
        #$update->save();
        $reg = registro::select('id_estatus')->where('folio',$data['folio'])->get();
        foreach ($reg as $e)
        if($e->id_estatus == '11'){ 
            $vista = 'Planeacion';
        }else{
            if($e->id_estatus == '9'){ 
                $vista = 'Analisis';
            }else{ 
                $vista = 'Construccion';
            }
        }
        return redirect(route($vista,$data->folio));
        #dd($vista);
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
