<?php

namespace App\Http\Controllers;

use App\Mail\ValidacionCliente;
use App\Mail\ValidacionRequerimiento;
use App\Models\levantamiento;
use App\Models\registro;
use App\Models\responsable;
use App\Models\sistema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

class CorreoController extends Controller
{
    //
    
    public function send($folio){
        $registros = registro::select('*')-> where ('folio', $folio)->get();
        return view('layouts.correo',compact('registros'));
        #dd($registros);
    }
    public function sended(request $data){
        mail::to($data->email)
            ->send(new ValidacionCliente($data->folio));
        $estatus = registro::select("*")-> where ('folio', $data->folio)->first();
        
        $estatus->id_estatus = $data->input('id_estatus');
        $estatus->save();
        return redirect('formatos.requerimientos.edit');
        #dd($estatus);
    }
    protected function PDF($folio){
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

    protected function respuesta($folio){
        $hora = levantamiento::findOrFail($folio);
        if($hora->fechaaut == NULL){ 
            $hora -> fechaaut = now();
            $hora -> save();
        return 'Se ha autorizado satisfactoriamente';        
        } else{
            return ('Ya ha sido autorizado');
        }
    }

    public function rechazo($folio){
        $fol= registro::where('folio',$folio)->get();
        mail::to("alejandro.martinez@3ti.mx")
            ->send(new ValidacionRequerimiento($folio));
        return 'Se ha enviado la respuesta, gracias.';
        #dd($estatus);
    }
}
