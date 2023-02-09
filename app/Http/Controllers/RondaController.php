<?php

namespace App\Http\Controllers;

use App\Models\desfase;
use App\Models\planeacion;
use App\Models\liberacion;
use App\Models\registro;
use App\Models\ronda;
use Illuminate\Http\Request;

class RondaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($folio)
    {
        $id = registro::select('folio')->where('folio',$folio)->first();
        $registros = registro::select('folio', 'id_estatus')->where('folio',$folio)->get();
        $ronda = ronda::where('folio',$folio)->count();
        $solinf = liberacion::where('folio',$folio)->whereNotNull('inicio_lib')->count();
        /*if($solinf === 0){
            $solinf = 1;
        }*/
        $vacio = planeacion:: select('*')->where('folio',$folio)->count();
        return view('formatos.requerimientos.seguimiento.pruebas.rondas',compact('id','registros','ronda','solinf','vacio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        ronda::create([
            'folio' => $data['folio'],
            'ronda' => $data['ronda'],
            'aprobadas' => $data['aprobadas'],
            'rechazadas' => $data['rechazadas'],
            'evidencia' => $data['evidencia'],
            'efectividad' => ($data['aprobadas']/($data['aprobadas']+$data['rechazadas']))*100,
        ]);
        $estatus = registro::select()->where('folio', $data['folio'])->first();
        if ($data['rechazadas'] == 0){$estatus->id_estatus = 2;}else{$estatus->id_estatus = 8;}
        $estatus->save();
        return redirect(route('Editar'));
        #dd($data);
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
    public function edit(Request $data)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data, $id_puesto)
    {
        $update = ronda::FindOrFail($id_puesto);
        $update->puesto = $data['puesto'];
        $update->jerarquia = $data['jerarquia'];
        $update->save();  
        return redirect(route('Seguir'));
        #dd($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_puesto)
    {
        $puesto = ronda::find($id_puesto);
        $puesto->delete();
        return redirect(route('Seguir'));
        #dd($id_estatus);
    }
}
