<?php

namespace App\Http\Controllers;

use App\Models\estatu;
use App\Models\registro;
use App\Models\responsable;
use App\Models\sistema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuildController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $registros = registro::where('folio', 'like', 'PIP%')->count();
        $sistema = sistema::all();
        $responsable = responsable::orderby('apellidos', 'asc')->get();
        $cliente = db::table('clientes')->orderby('id_cliente', 'asc')->get();
        $id = registro::latest('id_registro')->first();
        $estatus = estatu::all();
        $vacio = registro:: select('*')->count();
        #view('formatos.requerimientos.new');
        #dd($registros);
        return view('soportes.reporte',compact('sistema','responsable','cliente','registros','id','estatus','vacio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        /*departamento::create([
            'departamento' => $data['departamento'],
        ]);
        return redirect(route('Seguir'));
        #dd($data);*/
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
        $registros = registro::where('folio', 'like', 'PIP%')->count();
        $sistema = sistema::all();
        $responsable = responsable::orderby('apellidos', 'asc')->get();
        $cliente = db::table('clientes')->orderby('id_cliente', 'asc')->get();
        $id = registro::latest('id_registro')->first();
        $estatus = estatu::all();
        $vacio = registro:: select('*')->count();
        return view('soportes.primern',compact('sistema','responsable','cliente','registros','id','estatus','vacio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data, $id)
    {
        /*$update = departamento::FindOrFail($id);
        $update->departamento = $data['departamento'];
        $update->save();  
        return redirect(route('Seguir'));*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        #$id = departamento::find($id);
        #$id->delete();
        return redirect(route('Seguir'));
    }
    public function soporte(Request $data, $folio){
        $col = $data['columna'];
        $upd=db::table($data['tabla'])->where('folio',$folio)->first();
        $upd->$col = $data['dato'];
        $upd->save();
        #return redirect(route('Documentos',$folio));
        dd($upd);
    }
}
