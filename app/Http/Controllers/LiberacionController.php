<?php

namespace App\Http\Controllers;

use App\Models\construccion;
use App\Models\desfase;
use App\Models\liberacion;
use App\Models\registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class LiberacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($folio){
        $desfases = desfase::all();
        $id = registro::latest('id_registro')->first();
        $previo = liberacion::select('*')->where('folio',Crypt::decrypt($folio))->get();
        $registros = registro::select('registros.folio', 'registros.id_estatus','p.evidencia as def','l.fecha_def')
          ->leftjoin('levantamientos as l','registros.folio','l.folio')
          ->leftjoin('planeacion as p','registros.folio','p.folio')
          ->where('registros.folio',Crypt::decrypt($folio))->first();
        $vacio = liberacion:: select('*')->where('folio',Crypt::decrypt($folio))->count();
        return view('formatos.requerimientos.liberacion',compact('desfases','id','previo','registros','vacio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $data){
        $val = construccion::select('fechaCompReqR')->where('folio',$data['folio'])->get();
        foreach($val as $fecha){$this->validate($data, ['fecha_lib_a' => "required|date|after_or_equal:$fecha->fechaCompReqR"]);}
        $verificar = liberacion::where('folio',$data['folio'])->count();
        if($data['fecha_lib_a']<>NULL){$fecha_lib_a=date("y/m/d", strtotime($data['fecha_lib_a']));}else{$fecha_lib_a=NULL;}
        if($data['fecha_lib_r']<>NULL){
            if($data['fecha_lib_a'] <> NULL){
                $this->validate($data, ['fecha_lib_r' => "required|date|after_or_equal:$data[fecha_lib_a]"]);
            }
            $fecha_lib_r=date("y/m/d", strtotime($data['fecha_lib_r']));
        }else{$fecha_lib_r=NULL;}
        if($data['inicio_lib']<>NULL){
            if($data['fecha_lib_a'] <> NULL){
                $this->validate($data, ['inicio_lib' => "required|date|after_or_equal:$data[fecha_lib_a]"]);
            }
            $inicio_lib=date("y/m/d", strtotime($data['inicio_lib']));
        }else{$inicio_lib=NULL;}
        if($data['inicio_p_r']<>NULL){
            if($data['fecha_lib_a'] <> NULL){
                $this->validate($data, ['inicio_p_r' => "required|date|after_or_equal:$data[fecha_lib_a]"]);
            }
            $inicio_p_r=date("y/m/d", strtotime($data['inicio_p_r']));
        }else{$inicio_p_r=NULL;}
        if($data['id_estatus'] == 2){
            $this->validate($data, ['fecha_lib_r' => "required|date|after_or_equal:$data[fecha_lib_a]"]);
            $this->validate($data, ['inicio_lib' => "required|date|after_or_equal:$data[fecha_lib_a]"]);
            $this->validate($data, ['inicio_p_r' => "required|date|after_or_equal:$data[fecha_lib_a]"]);
        }
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
            $estatus->id_estatus = 8;
            $estatus->save();
            $update->save(); 
        }
        $update = registro::select()-> where ('folio', $data->folio)->first();
        $update->id_estatus = 8;
        $update->save();
        if($data['estatus'] === 'Ronda'){
            return redirect(route('Ronda',Crypt::encrypt($data['folio'])));
        }
        else{
            return redirect(route('Documentos',Crypt::encrypt($data['folio'])));
        }
        dd($data);

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
