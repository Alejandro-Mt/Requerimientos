<?php

namespace App\Http\Controllers;

use App\Models\solicitante;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Solicitantescontroller extends Controller
{
use RegistersUsers;
#protected $redirectTo = route('Seguir');

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 
                'string', 
                'email', 'ends_with:triplei.mx,it-strategy.mx,zacatepromotion.mx,idmkt.mx,stlog.mx',
                'max:255', 
                'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
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
            'a_pat'=> $data['apaterno'], 
            'a_mat'=> $data['amaterno'], 
            'email' => $data['email'], 
            'id_division' => $data['id_division'], 
        ]);
        User::create([
            'nombre' => $data['nombre'],
            'apaterno'=>$data['apaterno'],
            'amaterno'=>$data['amaterno'],
            'email' => $data['email'],
            'id_puesto' => 1,
            'id_area' => $data['id_area'],
            'password' => Hash::make($data['password']),
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
        $update->id_division = $data['id_division'];
        $update->save();  
        return redirect(route('Seguir'));
        #dd($update);
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
