<?php

namespace App\Http\Controllers;

use App\Models\registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $tabla = db::table('registros as r')
                        ->select('r.folio',
                            'descripcion',
                            'e.titulo',
                            'cl.clase',
                            'subproceso',
                            'l.impacto',
                            'nombre_s',
                            db::raw("ifnull(ar.nombre_r,'NO ASIGNADO') as Arquitecto"),
                            'nombre_cl',
                            're.nombre_r',
                            db::raw("CONCAT(r.folio,' ', descripcion) as Bitrix"),
                            'r.created_at as solicitud',
                            'l.created_at as formato',
                            db::raw("TIMESTAMPDIFF(day,r.created_at,ifnull(l.created_at,now())) as Dif"),
                            'fechaaut as Autorizacion',
                            db::raw("ifnull(TIMESTAMPDIFF(day,l.created_at,ifnull(fechaaut,now())),0) as difAut"),
                            'fechades',
                            db::raw("ifnull(TIMESTAMPDIFF(day,l.fechaaut,ifnull(l.fechades,now())),0) as difdes"),
                            'p.fechaCompReqC',
                            'p.evidencia',
                            'p.fechaCompReqR',
                            db::raw("ifnull(TIMESTAMPDIFF(day,p.fechaCompReqC,ifnull(p.fechaCompReqR,now())),0) as diascomp"),
                            'df.motivo',
                            'p.motivopausa',
                            'p.evPausa',
                            'p.fechaReact',
                            'an.fechaCompReqC as envioAnalisis',
                            'dfa.motivo as motivodesfase',
                            db::raw("ifnull(TIMESTAMPDIFF(day,p.fechaCompReqR,ifnull(an.fechaCompReqC,now())),0) as diasAn"),
                            'an.fechaCompReqR as autCl',#revisar texto que se solicita en analisis
                            db::raw("ifnull(TIMESTAMPDIFF(day,an.fechaCompReqC,ifnull(an.fechaCompReqR,now())),0) as diasAut"),
                            'co.fechaCompReqC as fechaConst',
                            'dfc.motivo as motivoDC',
                            #db::raw("ifnull(TIMESTAMPDIFF(day,an.fechaCompReqC,ifnull(an.fechaCompReqR,now())),0) as diasAut")
                            'i.solInfopip',
                            'i.solInfoC',
                            'i.respuesta',
                            'dfi.motivo as mri',
                            db::raw("ifnull(TIMESTAMPDIFF(day,i.solInfoC,ifnull(i.respuesta,now())),0) as diasInfo"),
                            'lib.fecha_lib_a',
                            'lib.fecha_lib_r',
                            db::raw("ifnull(TIMESTAMPDIFF(day,lib.fecha_lib_a,ifnull(lib.fecha_lib_r,now())),0) as diasL"),
                            'lib.inicio_lib',
                            db::raw("ifnull(TIMESTAMPDIFF(day,lib.fecha_lib_r,ifnull(lib.inicio_lib,now())),0) as diasInicioL"),
                            'lib.inicio_p_r',
                            db::raw("ifnull(TIMESTAMPDIFF(day,lib.inicio_lib,ifnull(lib.inicio_p_r,now())),0) as diasPL"),
                            'lib.t_pruebas',
                            'lib.evidencia_p',
                            'imp.cronograma',
                            'imp.link_c',
                            'imp.f_implementacion',
                            'imp.estatus_f',
                            'imp.seguimiento',
                            'imp.comentarios',
                            db::raw("ifnull(TIMESTAMPDIFF(day,r.created_at,ifnull(f_implementacion,null)),0) as duracion"))
                            #db::raw("ifnull(TIMESTAMPDIFF(day,l.fechades,ifnull(p.fechaCompReqC,now())),0) as diasconf"))
                        ->join('sistemas as s','r.id_sistema', 's.id_sistema')
                        ->join('responsables as re','r.id_responsable','re.id_responsable')
                        ->join('clientes as c','c.id_cliente','r.id_cliente')
                        ->join('estatus as e', 'e.id_estatus','r.id_estatus')
                        ->leftJoin('clases as cl', 'cl.id_clase','r.id_clase')
                        ->leftjoin('responsables as ar','r.id_arquitecto','ar.id_responsable')
                        ->leftjoin('levantamientos as l','r.folio','l.folio')
                        ->leftJoin('subprocesos as sub','r.folio','sub.folio')
                        ->leftJoin('planeacion as p', 'r.folio','p.folio')
                        ->leftjoin('desfases as df', 'p.motivodesfase', 'df.id')
                        ->leftJoin('analisis as an', 'r.folio', 'an.folio')
                        ->leftjoin('desfases as dfa', 'an.motivodesfase', 'dfa.id')
                        ->leftJoin('construccion as co', 'r.folio', 'co.folio')
                        ->leftJoin('desfases as dfc', 'co.motivodesfase', 'dfc.id')
                        ->leftJoin('informacion as i', 'r.folio','i.folio')
                        ->leftJoin('desfases as dfi', 'i.motivoRetrasoInfo', 'dfi.id')
                        ->leftJoin('liberaciones as lib', 'r.folio', 'lib.folio')
                        ->leftJoin('implementaciones as imp', 'r.folio', 'imp.folio')
                        ->get();
        return view('principal',compact('tabla'));
        #dd($tabla);
    }

}
