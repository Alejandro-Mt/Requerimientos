<?php

namespace App\Http\Controllers;

use App\Mail\SegundaValidacion;
use App\Mail\ValidacionCliente;
use App\Mail\ValidacionRequerimiento;
use App\Models\archivo;
use App\Models\levantamiento;
use App\Models\liberacion;
use App\Models\registro;
use App\Models\responsable;
use App\Models\sistema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PDF;

class CorreoController extends Controller
{
    //
    
    public function send($folio){
        $registros = registro::where ('folio', Crypt::decrypt($folio))->get();
        $archivos = archivo::where ('folio', Crypt::decrypt($folio))->get();
        return view('layouts.correo',compact('registros','folio','archivos'));
        #dd($registros);
    }
    public function sended(request $data){
        $destino = implode(';', $data['email']);
        mail::to(explode(';', $destino))
            ->send(new ValidacionCliente($data->folio));
        if(count(Mail::failures()) < 1){
            $estatus = registro::select("*")-> where ('folio', $data->folio)->first();
            $estatus->id_estatus = $data->input('id_estatus');
            $estatus->save();
			$a = "El Correo ha sido enviado "; 
            return redirect(route('Documentos',Crypt::encrypt($data->folio)))->with('alert', $a);
		}else{
			$b ='No se pudo enviar el correo. Vuelve a intentarlo. ';
            return redirect(route('Documentos',Crypt::encrypt($data->folio)))->with('alert', $b);
		} 
    }

    protected function PDF($folio){
        $formato = db::table('registros as r')
                          ->select('l.created_at as fsol',
                                    'r.descripcion',
                                    'a.area',
                                    db::raw("concat(sol.nombre,' ',sol.a_pat,' ',ifnull(sol.a_mat,' ')) as solicitante"),
                                    'd.departamento',
                                    'jd.nombre_r as j_dep',
                                    's.nombre_s',
                                    'c.nombre_cl',
                                    'au.nombre_r as autorizo',
                                    'au.apellidos',
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
                          ->leftJoin('departamentos as d','l.departamento','d.id')
                          ->leftJoin('responsables as jd','l.jefe_departamento','jd.id_responsable')
                          ->leftJoin('sistemas as s','r.id_sistema', 's.id_sistema')
                          ->leftJoin('clientes as c','c.id_cliente','r.id_cliente')
                          ->leftJoin('responsables as au','l.autorizacion','au.id_responsable')
                          ->leftJoin('solicitantes as sol','sol.id_solicitante','l.id_solicitante')
                          ->where('l.folio', Crypt::decrypt($folio))->get();
        $sistemas = sistema::all();
        $responsables = responsable::all();
        foreach($formato as $fold){
            $relaciones = explode(',',$fold->relaciones);
            $involucrados = explode(',',$fold->involucrados);
            $titulo = Crypt::decrypt($folio);
            $pdf = PDF::loadView('correos.Plantilla',compact('formato','involucrados','relaciones','responsables','sistemas'));
            return $pdf -> stream ("$titulo $fold->descripcion.pdf");
            #return view('correos.Plantilla',compact('formato','involucrados','relaciones','responsables','sistemas'));
        }
    }

    protected function respuesta($folio){
        $hora = levantamiento::findOrFail($folio);
        $fol = registro::
                leftJoin('responsables as res','registros.id_responsable', 'res.id_responsable')
                ->where('registros.folio',$folio)
                ->first();
        if($hora->fechaaut == NULL){ 
            $hora -> fechaaut = now();
            $hora -> save();
                mail::to($fol->email)
                    ->send(new ValidacionRequerimiento($folio));
                return 'Se ha autorizado satisfactoriamente';   
        }else{
            if($fol->id_estatus == 11 && $hora->fechades == NULL){
                $hora -> fechades = now();
                $hora -> save();
                mail::to($fol->email)
                    ->send(new ValidacionRequerimiento($folio));
                return 'Se ha autorizado satisfactoriamente';   
            }else
            return ('Ya ha sido autorizado');
        }
    }

    public function rechazo($folio){
        $fol = registro::select('dispercion')
                      ->leftJoin('sistemas as s','registros.id_sistema', 's.id_sistema')
                      ->where('folio',$folio)
                      ->get();
        $hora = levantamiento::findOrFail($folio);
        if($hora->fechaaut == NULL){ 
            foreach($fol as $correo){
                mail::to($correo->dispercion)
                    ->send(new ValidacionRequerimiento($folio));
                return 'Se ha enviado la respuesta, gracias.';
            #dd($correo->dispercion);  
            }
        } else{
          return ('El folio ya ha sido autorizado, en caso de querer cancelarlo por favor contacte a soporte');
        }
    }

    protected function impacto($folio,$impacto){
        $hora = levantamiento::findOrFail($folio);
        $correo = registro::select('res.email')
                      ->leftJoin('responsables as res','registros.id_responsable', 'res.id_responsable')
                      ->where('folio',$folio)
                      ->first();
        if($hora->fechades == NULL){ 
            #$hora -> fechades = now();
            $hora -> impacto = $impacto;
            $hora -> save();
            mail::to($correo->email)
                ->send(new SegundaValidacion($folio));
            return 'Se ha enviado la respuesta, gracias.';     
        } else{
            return ('Ya ha sido autorizado');
            #dd($hora);
        }
        dd($impacto);
        
    }

    /*public function requiere($folio){
        $fol = registro::select('res.email')
                      ->leftJoin('responsables as res','registros.id_responsable', 'res.id_responsable')
                      ->where('folio',$folio)
                      ->get();
        $hora = levantamiento::findOrFail($folio);
        if($hora->fechades == NULL){ 
            foreach($fol as $correo){
                mail::to($correo->email)
                    ->send(new SegundaValidacion($folio));
                return 'Se ha enviado la respuesta, gracias.';
            #dd($correo->email);  
            }
        } else{
          return ('Este folio ya ha sido contestado');
        }
    }*/

    public function segval ($folio){
        $estatus = registro::select('id_estatus')->where('folio',$folio)->first();
        switch($estatus->id_estatus){
            case 7:
                $update = levantamiento::FindOrFail($folio);
                $update->fechades = now(); 
                $update->save();
            break;
            case 2:
                $update = liberacion::FindOrFail($folio);
                $update->evidencia_p = true; 
                $update->save();
            break;
        }
        return redirect(route('Documentos',Crypt::encrypt($folio)));
        #return ($update);
    }
    function store(Request $data,$folio){ 
        $rename = $data->file('adjunto')->getClientOriginalName();
        $data->validate(['adjunto'=>'required']);{
        $files = Storage::putFileAs("public/$data->folio", $data->file('adjunto'),$rename);
        $url = Storage::url($files);
        if(archivo::where('url', 'like', '%' . $rename . '%')->count() == 0)
            archivo::create([
                'folio'=>$data->folio,
                'url'=>$url
            ]);
        }
    }
    public function destroy($name){
        #$name = pathinfo($data->file, PATHINFO_FILENAME);
        $archivos = archivo::where('url', 'like', '%' . $name . '%')->get();
        foreach($archivos as $archivo){
            $file = str_replace('storage',"public",$archivo->url);
            Storage::delete($file);
            $archivo->delete();
        }
        /*$url = archivo::FindOrFile($id);
        $file = str_replace('storage',"public/$url->folio",$url->url);
        Storage::delete($file);
        $url->delete($id);*/
    }

}
