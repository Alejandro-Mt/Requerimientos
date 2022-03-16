<?php

namespace App\Http\Controllers;

use App\Models\responsable;
use Illuminate\Http\Request;

class ResponsableController extends Controller
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
        responsable::create([
            'nombre_r' => $data['nombre_r'], 
            'apellidos'=> $data['apellidos'], 
            'email' => $data['email'], 
            'id_area' => $data['id_area']
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
    public function update(Request $data,$id_responsable)
    {
        $update = responsable::FindOrFail($id_responsable);
        $update->nombre_r = $data['nombre_r']; 
        $update->apellidos= $data['apellidos']; 
        $update->email = $data['email'];
        $update->id_area = $data['id_area'];
        $update->save();  
        return redirect(route('Seguir'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_responsable)
    {
        $id_responsable = responsable::find($id_responsable);
        $id_responsable->delete();
        return redirect(route('Seguir'));
    }
}
