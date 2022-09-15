<?php

namespace App\Http\Controllers;

use App\Models\acceso;
use App\Models\area;
use App\Models\puesto;
use App\Models\sistema;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermissionsController extends Controller
{
    //
    public function ajustes(){
        $areas = area::all();
        $equipo = 
            user::distinct()
                ->select('users.*')
                ->join('accesos as acs','users.id','acs.id_user')
                ->wherein(
                    'acs.id_sistema',
                    acceso::
                        select('id_sistema')
                        ->where('id_user',Auth::user()->id)
                )
                ->where('id_puesto','<=',Auth::user()->id_puesto)
                ->get();
        $puestos = puesto::all();
        $usuarios = DB::table('users as u')
                     ->select('u.id_puesto', 'p.jerarquia')
                     ->leftjoin('puestos as p', 'u.id_puesto','p.id_puesto')
                     ->where('u.id', auth::user()->id)
                     ->get();
        $accesos = acceso::all();
        $sistemas = sistema::join('accesos as acs', 'sistemas.id_sistema','acs.id_sistema')->where('id_user',Auth::user()->id)->get();
        foreach($usuarios as $usuario){
            return view('formatos.ajustes',compact('accesos','areas','equipo','puestos','sistemas','usuario'));
            #dd($equipo);
        };
    }

    protected function edit(request $data){
        //
        $us = auth::user()->count;
        foreach($data->id as $key => $value){
            for($i=-1;$i<$key;$i++){
                $actualizar = user::FindOrFail($data['id'][$key]);
                $actualizar->id_puesto = $data['id_puesto'][$key];
                $actualizar->id_area = $data['id_area'][$key];
                $actualizar->save();
            }
        }
        return redirect(route('Ajustes'));
        dd($actualizar);
    }
}
