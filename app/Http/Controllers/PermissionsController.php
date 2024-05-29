<?php

namespace App\Http\Controllers;

use App\Models\acceso;
use App\Models\area;
use App\Models\departamento;
use App\Models\puesto;
use App\Models\sistema;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionsController extends Controller
{
    //
    public function ajustes(){
        $areas = area::all();
        $departamentos = departamento::all();
        if (Auth::user()->id == 1) {
            # code...
            $equipo = user::all();
        } else {
            # code...
            $equipo = user::distinct()
                ->select('users.*')
                ->leftjoin('accesos as acs','users.id','acs.id_user')
                ->wherein(
                    'acs.id_sistema',
                    acceso::
                        select('id_sistema')
                        ->where('id_user',Auth::user()->id)
                )
                ->where('id_puesto','<=',Auth::user()->usrdata->id_puesto)
                ->get();
        }
        $puestos = puesto::all();
        $accesos = acceso::all();
        $sistemas = sistema::join('accesos as acs', 'sistemas.id_sistema','acs.id_sistema')->where('id_user',Auth::user()->id)->get();
            return view('formatos.ajustes',compact('accesos','areas','departamentos','equipo','puestos','sistemas'));
    }

    protected function edit(request $data){
        //
        $us = auth::user()->count;
        foreach($data->id as $key => $value){
            for($i=-1;$i<$key;$i++){
                $actualizar = user::FindOrFail($data['id'][$key]);
                $actualizar->usrdata->id_puesto = $data['id_puesto'][$key];
                $actualizar->usrdata->id_area = $data['id_area'][$key];
                $actualizar->usrdata->id_departamento = $data['id_departamento'][$key];
                $actualizar->save();
            }
        }
        return redirect(route('Ajustes'));
        dd($actualizar);
    }
}
