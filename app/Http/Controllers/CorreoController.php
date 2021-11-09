<?php

namespace App\Http\Controllers;

use App\Models\responsable;
use App\Models\sistema;
use Illuminate\Support\Facades\DB;
use \PDF;
use Illuminate\Http\Request;

class CorreoController extends Controller
{
    //
    protected function test($folio){
        #set_time_limit(180);
        
        $formato = db::table('registros as r')
                          ->select('l.created_at as fsol',
                                    'a.area',
                                    'l.solicitante',
                                    'jd.nombre_r as j_dep',
                                    's.nombre_s',
                                    'c.nombre_cl',
                                    'au.nombre_r as autorizo',
                                    'l.previo',
                                    'l.impacto',
                                    'l.problema',
                                    'l.general',
                                    'l.detalle',
                                    'l.esperado',
                                    'l.relaciones',
                                    'l.involucrados')
                          ->leftjoin('levantamientos as l', 'r.folio', 'l.folio')
                          ->leftJoin('areas as a', 'r.id_area','a.id_area')
                          ->leftJoin('responsables as jd','l.jefe_departamento','jd.id_responsable')
                          ->leftJoin('sistemas as s','r.id_sistema', 's.id_sistema')
                          ->leftJoin('clientes as c','c.id_cliente','r.id_cliente')
                          ->leftJoin('responsables as au','l.autorizacion','au.id_responsable')
                          ->where('l.folio', $folio)->get();
        $sistemas = sistema::all();
        $responsables = responsable::all();
        foreach($formato as $fold){
        $relaciones = explode(',',$fold->relaciones);
        $involucrados = explode(',',$fold->involucrados);
        $pdf = PDF::loadView('correos.Plantilla',compact('formato','involucrados','relaciones','responsables','sistemas'));
        return $pdf -> stream ('documento.pdf');
        #return view('correos.Plantilla',compact('formato','involucrados','relaciones','responsables','sistemas'));
        }
    }
}
