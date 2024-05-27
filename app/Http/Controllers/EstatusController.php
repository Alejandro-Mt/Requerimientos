<?php

namespace App\Http\Controllers;

use App\Models\estatu;
use Illuminate\Http\Request;

class EstatusController extends Controller
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
        estatu::create([
            'titulo' => $data['titulo'],
            'activo'=> $data['activo'],
            'posicion'=> $data['posicion'],
            'id_fase'=> $data['id_fase']
        ]);
        return redirect(route('Seguir'));
        #dd($url);
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
    public function edit(Request $request)
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
    public function update(Request $data, $id_estatus)
    {
        $update = estatu::FindOrFail($id_estatus);
        $update->titulo = $data['titulo'];
        $update->activo= $data['activo']; 
        $update->posicion= $data['posicion'];
        $update->id_fase= $data['id_fase'];
        $update->save();  
        return redirect(route('Seguir'));
        #dd($rename);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_estatus)
    {
        $id_sistema = estatu::find($id_estatus);
        $id_sistema->delete();
        return redirect(route('Seguir'));
    }
}
