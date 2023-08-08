<?php

namespace App\Http\Controllers;

use App\Mail\Cliente\Fase;
use App\Models\acceso;
use App\Models\archivo;
use App\Models\area;
use App\Models\Cliente;
use App\Models\comentario;
use App\Models\departamento;
use App\Models\division;
use App\Models\estatu;
use App\Models\funcionalidad;
use App\Models\levantamiento;
use App\Models\pausa;
use App\Models\planeacion;
use App\Models\puesto;
use App\Models\registro;
use App\Models\responsable;
use App\Models\sistema;
use App\Models\solicitante;
use App\Models\solicitud;
use App\Models\subproceso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Mpdf\Tag\Select;

class MenuController extends Controller
{
   
    /*public function create()
    {
        return view('formatos.requerimientos.new');
    }*/


    public function edit(){
        $subprocesos = subproceso::all();
        $sistemas = 
            sistema::
                join('registros as r','r.id_sistema','sistemas.id_sistema')
                ->wherein('r.id_sistema',acceso::select('id_sistema')->where('id_user',auth::user()->id))
                ->groupby('sistemas.id_sistema')
                ->get();
        $cliente = 
            cliente::
                join('registros as r','r.id_cliente','clientes.id_cliente')
                ->groupby('clientes.id_cliente')
                ->get();
        $requerimiento = registro::select('registros.*','e.*','c.nombre_cl','l.fechaaut','l.fechades')
                            ->join('estatus as e','e.id_estatus', 'registros.id_estatus')
                            ->join('clientes as c','c.id_cliente','registros.id_cliente')
                            ->leftjoin('levantamientos as l','l.folio', 'registros.folio')
                            ->orderby('registros.id_registro','desc')
                            ->wherein('registros.id_sistema',acceso::select('id_sistema')->where('id_user',auth::user()->id))
                            ->where('registros.id_estatus','17')
                            ->get();
        $levantamiento = registro::select('registros.*','e.*','c.nombre_cl','l.fechaaut','l.fechades')
                            ->join('estatus as e','e.id_estatus', 'registros.id_estatus')
                            ->join('clientes as c','c.id_cliente','registros.id_cliente')
                            ->leftjoin('levantamientos as l','l.folio', 'registros.folio')
                            ->orderby('registros.id_registro','desc')
                            ->wherein('registros.id_sistema',acceso::select('id_sistema')->where('id_user',auth::user()->id))
                            ->where(function ($query){
                                $query->where('registros.id_estatus', '10')
                                    ->orwhere('registros.id_estatus', '16');
                            })
                            ->get();
        $construccion = registro::select('registros.*','e.*','c.nombre_cl','l.fechaaut','l.fechades')
                            ->join('estatus as e','e.id_estatus', 'registros.id_estatus')
                            ->join('clientes as c','c.id_cliente','registros.id_cliente')
                            ->leftjoin('levantamientos as l','l.folio', 'registros.folio')
                            ->orderby('registros.id_registro','desc')
                            ->wherein('registros.id_sistema',acceso::select('id_sistema')->where('id_user',auth::user()->id))
                            ->where(function ($query){
                                $query->where('registros.id_estatus', '11')
                                    ->orwhere('registros.id_estatus', '9')
                                    ->orwhere('registros.id_estatus','7');
                            })
                            ->get();
        $liberacion = registro::select('registros.*','e.*','c.nombre_cl','l.fechaaut','l.fechades')
                            ->join('estatus as e','e.id_estatus', 'registros.id_estatus')
                            ->join('clientes as c','c.id_cliente','registros.id_cliente')
                            ->leftjoin('levantamientos as l','l.folio', 'registros.folio')
                            ->orderby('registros.id_registro','desc')
                            ->wherein('registros.id_sistema',acceso::select('id_sistema')->where('id_user',auth::user()->id))
                            ->where('registros.id_estatus','8')
                            ->get();
        $implementacion = registro::select('registros.*','e.*','c.nombre_cl','l.fechaaut','l.fechades')
                            ->join('estatus as e','e.id_estatus', 'registros.id_estatus')
                            ->join('clientes as c','c.id_cliente','registros.id_cliente')
                            ->leftjoin('levantamientos as l','l.folio', 'registros.folio')
                            ->orderby('registros.id_registro','desc')
                            ->wherein('registros.id_sistema',acceso::select('id_sistema')->where('id_user',auth::user()->id))
                            ->where('registros.id_estatus','2')
                            ->get();
        $implementado = registro::select('registros.*','e.*','c.nombre_cl','l.fechaaut','l.fechades')
                            ->join('estatus as e','e.id_estatus', 'registros.id_estatus')
                            ->join('clientes as c','c.id_cliente','registros.id_cliente')
                            ->leftjoin('levantamientos as l','l.folio', 'registros.folio')
                            ->orderby('registros.id_registro','desc')
                            ->wherein('registros.id_sistema',acceso::select('id_sistema')->where('id_user',auth::user()->id))
                            ->where('registros.id_estatus','18')
                            ->get();
        $cancelado = registro::select('registros.*','e.*','c.nombre_cl','l.fechaaut','l.fechades')
                            ->join('estatus as e','e.id_estatus', 'registros.id_estatus')
                            ->join('clientes as c','c.id_cliente','registros.id_cliente')
                            ->leftjoin('levantamientos as l','l.folio', 'registros.folio')
                            ->orderby('registros.id_registro','desc')
                            ->wherein('registros.id_sistema',acceso::select('id_sistema')->where('id_user',auth::user()->id))
                            ->where(function ($query){
                                $query->where('registros.id_estatus', '14')
                                    ->orwhere('registros.id_estatus', '13');
                            })
                            ->get();
        $pausa = pausa::select('r.folio',pausa::raw('max(pausas.pausa) as pausa'))->rightjoin('registros as r','r.folio', 'pausas.folio')->groupby('r.folio')->get();
        foreach ($pausa as $p);
        $vacio = pausa::count();
        return view('formatos.requerimientos.edit',compact('cancelado','cliente','construccion','implementacion','implementado','levantamiento','liberacion','pausa','requerimiento','sistemas','subprocesos','vacio'));
        #dd($requerimiento);
    }
    public function pause($folio){
        pausa::create([
            'folio'=> $folio,
            'pausa'=> '1'   
        ]);
        return redirect(route('Documentos',Crypt::encrypt($folio)));
    }
    public function play($folio){
        $reaunudar = pausa::select('*')-> where ('folio', $folio)->orderby('created_at','desc')->first();
        $reaunudar->pausa = '0';
        $reaunudar->save();  
        $email = levantamiento::join('solicitantes as s', 's.id_solicitante', '=', 'levantamientos.id_solicitante')
            ->where('folio', $folio)
            ->select('s.email')
            ->first();
        $gerencia = User::
            join('puestos as p','p.id_puesto','users.id_puesto')
            ->where('id_area', 6)
            ->whereIn('jerarquia',[4,5])
            ->select('email')
            ->get();
        if($email){
            Mail::to($email->email)->cc($gerencia->pluck('email'))->send(new Fase($folio, 'REANUDAR'));
        }
        return redirect(route('Documentos',Crypt::encrypt($folio)));
        #dd($email->correo);
    }
    public function subproceso($folio){
        $registros = registro::select('*')-> where ('folio', $folio)->get();
        $subprocesos = subproceso::latest('subproceso')-> where ('folio', $folio)->limit(1)->get();
        $vacio = subproceso:: select('*')->where ('folio', $folio)->count();
        return view('formatos.subproceso',compact('registros','vacio'));
        #dd($folio);
    }
    public function sub(request $data){
        
        if($data['previsto']<>NULL){$previsto=date("y/m/d", strtotime($data['previsto']));}else{$previsto=NULL;}
        subproceso::create([
            'folio'=>$data['folio'],
            'subproceso'=>$data['subproceso'],
            'previsto'=>$previsto,
            'estatus' =>$data['estatus']
        ]);
        #$registros = registro::select('*')-> where ('folio', $data->folio)->first();
        #$registros->id_estatus = $data->input('id_estatus');
        #$registros->save();  
        return redirect(route('Documentos',Crypt::encrypt($data['folio'])));
        #dd($registros->all());
    }
    public function close($folioS){
        $concluir = subproceso::select('*')-> where ('subproceso', $folioS)->first();
        $concluir->estatus = 'Concluido';
        $concluir->save();
        return redirect(route('Documentos',Crypt::encrypt($folioS)));
        #dd($concluir);
    }
    public function avance($folio){
        $registros= registro::where('folio',$folio)->get();
        $estatus = estatu::all();
        $comentarios = comentario::select ('nombre',
                                            'apaterno',
                                            'folio',
                                            'contenido',
                                            'p.puesto',
                                            'respuesta',
                                            'comentarios.created_at',
                                            'id_estatus')
                                    ->leftjoin ('users as u','u.id','comentarios.usuario')
                                    ->leftjoin ('puestos as p', 'u.id_puesto','p.id_puesto')
                                    ->where('folio',$folio)->get();
        $archivos = archivo::where('folio',$folio)->get();
        $formatos = levantamiento::where('folio',$folio)->count();
        $reg = planeacion::where('folio',$folio)->exists();
        if($reg){$link = planeacion::select('evidencia')->where('folio',$folio)->first();}else{$link = NULL;}
        return view('formatos.comentarios',compact('archivos','comentarios','estatus','folio','formatos','link','registros'));
        #dd($link);
    }
    public function comentar(Request $data){
        //validat datos
        $this->validate($data, [
            'contenido' => 'required|max:250',
        ]);
        //insertar 
        $e = registro::select('id_estatus')->where('folio',$data['folio'])->get();
        foreach ($e as $estatus)
         
        comentario::create([
            'folio'=> $data['folio'],
            'pausa'=> '1',
            'usuario' => auth::user()->id ,
            'contenido' => $data['contenido'],
            'respuesta' => $data['respuesta'],
            'id_estatus' => $estatus->id_estatus
        ]);
        //Redireccionar
        #$registros= registro::where('folio',$folio)->get();
        #$estatus = estatu::all();
        return redirect(route('Documentos',Crypt::encrypt($data->folio)));
        #dd($data->all());
    }
    public function store(){
        //validat datos
        /*$this->validate($data, [
            'contenido' => 'required'
        ]);*/
        //insertar 
        /*comentario::create([
            'folio'=> $data['folio'],
            'pausa'=> '1',
            'usuario' => auth::user()->id ,
            'contenido' => $data['contenido'],
            'respuesta' => $data['respuesta'],
        ]);*/
        //Redireccionar
        #$registros= registro::where('folio',$folio)->get();
        #$estatus = estatu::all();
        $areas = area::all();
        $clientes = Cliente::all();
        $departamentos = departamento::all();
        $divisiones = division::all();
        $estatus = estatu::all();
        $funcionalidad = funcionalidad::all();
        $puestos = puesto::all();
        $responsables = responsable::select('id_responsable','nombre_r','apellidos','email','responsables.id_area','area')->leftjoin('areas as a','responsables.id_area','a.id_area')->get();
        $sistemas = sistema::all();
        $solicitantes = solicitante::leftjoin('division as d','solicitantes.id_division','d.id_division')->get();
        return view('/layouts.datos',compact('areas','clientes','departamentos','divisiones','estatus','funcionalidad','puestos','responsables','sistemas','solicitantes'));
        #dd($responsables);
    }
    public function posponer($folio,$id_motivo,$id_estatus){
        pausa::create([
            'folio'=> $folio,
            'pausa'=> '2',
            'id_motivo'=>$id_motivo,
            'id_estatus'=>$id_estatus
        ]);
        $email = levantamiento::join('solicitantes as s', 's.id_solicitante', '=', 'levantamientos.id_solicitante')
            ->where('folio', $folio)
            ->select('s.email')
            ->first();
        $gerencia = User::
            join('puestos as p','p.id_puesto','users.id_puesto')
            ->where('id_area', 6)
            ->whereIn('jerarquia',[4,5])
            ->select('email')
            ->get();
        if($email){
            Mail::to($email->email)->cc($gerencia->pluck('email'))->send(new Fase($folio, 'POSPUESTO'));
        }
        return redirect(route('Documentos',Crypt::encrypt($folio)));
        #dd($email->email);
    }
}
