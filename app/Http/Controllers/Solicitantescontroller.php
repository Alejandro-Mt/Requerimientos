<?php

namespace App\Http\Controllers;

use App\Models\solicitante;
use Illuminate\Http\Request;

class Solicitantescontroller extends Controller
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
        solicitante::create([
            'nombre' => $data['nombre'], 
            'a_pat'=> $data['a_pat'], 
            'a_mat'=> $data['a_mat'], 
            'email' => $data['email'], 
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
        $update = solicitante::FindOrFail($id_responsable);
        $update->nombre = $data['nombre']; 
        $update->a_pat= $data['a_pat']; 
        $update->a_mat = $data['a_mat'];
        $update->email = $data['email'];
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
    public function destroy($id_solicitante)
    {
        $id_solicitante = solicitante::find($id_solicitante);
        $id_solicitante->delete();
        return redirect(route('Seguir'));
    }
}
