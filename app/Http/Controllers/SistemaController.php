<?php

namespace App\Http\Controllers;

use App\Models\sistema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SistemaController extends Controller
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
        sistema::create([
            'nombre_s' => $data['nombre_s'],
            'dispercion'=> $data['dispercion'],
            'activo'=> 1
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
    public function update(Request $data, $id_sistema)
    {
        $update = sistema::FindOrFail($id_sistema);
        $update->nombre_s   = $data['nombre_s'];
        $update->dispercion = $data['dispercion']; 
        $update->activo     = $data['activo'] ?? 0;
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
    public function destroy($id_sistema)
    {
        $id_sistema = sistema::find($id_sistema);
        $id_sistema->delete();
        return redirect(route('Seguir'));
    }
}
