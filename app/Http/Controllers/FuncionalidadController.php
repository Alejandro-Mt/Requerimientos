<?php

namespace App\Http\Controllers;

use App\Models\funcionalidad;
use Illuminate\Http\Request;

class FuncionalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        funcionalidad::create([
            'titulo' => $data['titulo'],
        ]);
        return redirect(route('Seguir'));
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
    public function update(Request $data, $id_estatus)
    {
        $update = funcionalidad::FindOrFail($id_estatus);
        $update->titulo = $data['titulo'];
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
    public function destroy($id_estatus)
    {
        $estatus = funcionalidad::find($id_estatus);
        $estatus->delete();
        return redirect(route('Seguir'));
        #dd($id_estatus);
    }
}
