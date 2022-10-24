<?php

namespace App\Http\Controllers;

use App\Models\pausa;
use App\Models\registro;
use App\Models\solicitud;
use App\Models\solpri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrioridadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitudes = 
            solpri::
                join('clientes as c','c.id_cliente','act_pri.id_cliente')->
                where('estatus',NULL)->
                get();
        $pendientes = 
            registro::
                join('sistemas as s','s.id_sistema','registros.id_sistema')
                ->wherenotin('registros.id_estatus',[13,14,18])
                ->wherenotin('folio',pausa::select('folio')->where('pausa',2)->distinct())
                ->get();
        return view('formatos.prioridad',compact('pendientes','solicitudes'));
        //dd($clientes);
    }

    public function update(Request $data,$id)
    {
        #dd($data);
        $autoriza = solpri::findOrFail($id);
        $autoriza->estatus = $data['estatus'];
        $autoriza->id_user = Auth::user()->id;
        $autoriza->save();
        return redirect(route('AutP'));
        //dd($clientes);
}

}
