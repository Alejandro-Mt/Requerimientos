<?php

namespace App\Http\Controllers;

use App\Models\area;
use App\Models\puesto;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermissionsController extends Controller
{
    //
    public function ajustes(){
        $areas = area::all();
        $equipo = user::where('id_area',Auth::user()->id_area)->get();
        $puestos = puesto::all();
        $usuarios = DB::table('users as u')
                     ->select('u.id_puesto', 'p.jerarquia')
                     ->leftjoin('puestos as p', 'u.id_puesto','p.id_puesto')
                     ->where('u.id', auth::user()->id)
                     ->get();
        foreach($usuarios as $usuario){
            return view('formatos.ajustes',compact('areas','equipo','puestos','usuario'));
            #dd($usuario->id);
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
