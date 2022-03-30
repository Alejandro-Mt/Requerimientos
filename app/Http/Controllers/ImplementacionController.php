<?php

namespace App\Http\Controllers;

use App\Models\desfase;
use App\Models\implementacion;
use App\Models\liberacion;
use App\Models\registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImplementacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($folio){
        $desfases = db::table('estatus_funcionalidad')->select('*')->get();
        $id = registro::latest('id_registro')->first();
        $previo = implementacion::select('*')->where('folio',$folio)->get();
        $registros = registro::select('folio', 'id_estatus')->where('folio',$folio)->get();
        $vacio = implementacion:: select('*')->where('folio',$folio)->count();
        return view('formatos.requerimientos.implementacion',compact('desfases','id','previo','registros','vacio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $data){ 
        $val = liberacion::select('fecha_lib_r')->where('folio',$data['folio'])->get();
        foreach($val as $fecha){$this->validate($data, ['f_implementacion' => "required|date|after_or_equal:$fecha->fecha_lib_r"]);}
        $verificar = implementacion::where('folio',$data['folio'])->count();
        if($data['f_implementacion']<>NULL){$f_implementacion=date("y/m/d", strtotime($data['f_implementacion']));}else{$f_implementacion=NULL;}
        if($data['cronograma']==NULL){$data['cronograma']= 0;}
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
