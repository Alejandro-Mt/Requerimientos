<?php

namespace App\Http\Controllers;

use App\Mail\Cliente\Fase;
use App\Mail\Interno\NuevoProyecto;
use App\Mail\interno\Tester;
use App\Models\bitacora;
use App\Models\clase;
use App\Models\estatu;
use App\Models\levantamiento;
use App\Models\registro;
use App\Models\responsable;
use App\Models\sistema;
use App\Models\solicitud;
use App\Models\solpri;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use DateTime;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class RecordController extends Controller
{
    protected function index(){
        
        $cliente = db::table('clientes')->orderby('id_cliente', 'asc')->get();
        $datos = null;
        $proyectos = registro::where('folio', 'like', 'PR-PIP%')->get();
        #$id = registro::latest('id_registro')->first();
        $registros = registro::where('folio', 'like', 'PIP%')->count();
        $responsable = User::orderby('nombre', 'asc')->get();
        $sistema = sistema::all();
        $vacio = registro:: select('*')->count();
        return view('formatos.requerimientos.new',compact('cliente','datos','proyectos','registros','responsable','sistema','vacio'));
        dd($proyectos);
    }

    /*public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'descripcion' => ['required', 'string', 'max:255'],
            'id_responsable' => ['required', 'string', 'max:255'],
            'id_sistema' => ['required', 'string', 'max:255'],
            'id_cliente' => ['required', 'string', 'max:255'],
        ]);
    }*/

    protected function create(request $data){
        $y = new DateTime('NOW');
        $y = $y->format('y');
        if ($data['es_pr'] == 1){
            $registros = registro::where('folio', 'like', "PR-PIP%-$y")->count();
            $registros = $registros + 1;
            if($registros<10){
                $folio = "PR-PIP-00$registros-$y";
            }
            else{
                if($registros<100){
                    $folio = "PR-PIP-0$registros-$y";
                }
                else{
                    $folio = "PR-PIP-$registros-$y";
                }
            }
            $destino = 
                db::
                    table('users as u')->
                    where('u.id_puesto','>',5)->get();
            foreach($destino as $correo){ 
                mail::to($correo->email)->send(new NuevoProyecto($data,$correo->nombre));
            } 
        }
        else{
            $registros = registro::where('folio', 'like', "PIP%-$y")->count();
            $registros = $registros + 1;
            if($registros<10){
                $folio = "PIP-00$registros-$y";
            }
            else{
                if($registros<100){
                    $folio = "PIP-0$registros-$y";
                }
                else{
                    $folio = "PIP-$registros-$y";
                }
            }
        }
        registro::create([
            'folio' => $folio,
            'descripcion' => $data['descripcion'],
            'id_responsable' => $data['id_responsable'],
            'id_sistema' => $data['id_sistema'],
            'id_cliente' => $data['id_cliente'],
            'id_estatus' => 17,
            'id_area' => 6,
            'id_arquitecto' => $data['id_arquitecto'],
            'id_clase' => $data['id_clase'],
            'es_proyecto' => $data['es_pr'],
            'folio_pr' => $data['folio_pr'],
            'es_emergente' => $data['es_em']
        ]);
        if($data['preregistro'] != NULL){
            $update = solicitud::where('folio',$data['preregistro'])->first();
            $update->id_estatus= '21';
            $update->folior = $folio;
            $update->save();
        }
        $listado = solpri::where([['estatus', 'autorizado'],['id_cliente',$data['id_cliente']]])->orderby('id','desc')->first();
        if(($listado) != NULL){
            $listado->orden = $listado->orden.','.$folio;
            $listado->save();
        }
        $notificacionSCC = solicitud::where('folio',$data['preregistro'])->first();
        $notificacionUser = Http::get('https://api-seguridadv2.tiii.mx/api/v1/login/validacionRF/0/'.$notificacionSCC->correo);
        $datos = $notificacionUser->json();
        $idSC = $datos['idUsuario'];
        $message = 'Hola! Te informamos que tu solicitud de requerimiento ha sido asignada con el folio '.$folio.'. En la siguiente liga encontraras mas información ~https://requerimientos.tiii.mx/preregistro.listado~. Gracias.';
        #dd($idSC,$message);
        $notificacionController = new NotificacionController();
        $notificacionController->stnotify($idSC,$message);
        #dd(($folio));
        return redirect(route('Nuevo'))->with('alert', $folio);
    }
    
    public function update(Request $data, $folio)
    {
        $registro = registro::where('folio',$folio)->first();
        $registro->id_estatus= 14;
        $registro->motivo_can_id = $data['motivo'];
        $email = levantamiento::join('users as s', 's.id', '=', 'levantamientos.id_solicitante')
            ->where('folio', $folio)
            ->select('s.email')
            ->first();
        dd($email);
        $involucrados = DB::
            table('responsables as res')->
            join('levantamientos as lev', function ($join) {
                $join->on(DB::raw('FIND_IN_SET(res.id_responsable, lev.involucrados)'), '>', DB::raw('0'));
            })->
            where('lev.folio', $folio)->
            get();
        $registro->save();
        /* $gerencia = User::
            join('puestos as p','p.id_puesto','users.id_puesto')
            ->where('id_area', 6)
            ->whereIn('jerarquia',[4,5])
            ->select('email')
            ->get();*/
        if($involucrados){
            Mail::to($email->email)->cc($involucrados->pluck('email'))->send(new Fase($folio,'14'));
        }
        return redirect(route('home'));
    }

  protected function tester(Request $data, $folio){
    $user                   = User::FindORFail(Auth::user()->id);
    $registro               = registro::where('folio',$folio)->first();
    $registro->id_tester    = $data['id_tester'];
    $registro->save();
    $campo                  = 
        bitacora::create([
          'folio'         => $registro->folio,
          'usuario'       => $user->getFullnameAttribute(),
          'id_user'       => $user->id,
          'campo'         => "Se asigna tester",
          'id_estatus'    => $registro->id_estatus,
        ]);
    mail::to($registro->rtest->email)->send(new Tester($folio));
    return redirect(route('Documentos',Crypt::encrypt($folio)));
    ####  Notificaciones por ST desactivadas  ###
    /*$notificacionUserC = Http::get('https://api-seguridadv2.tiii.mx/api/v1/login/validacionRF/0/'.$correo->rpip->email);
    $datos = $notificacionUserC->json();
    $idSC = $datos['idUsuario'];
    $message = 'Hola! Te informamos que desarrollo ha designado la clase del requerimiento con folio '.$folio. '. ~'.route("Documentos",Crypt::encrypt($folio)).'~.  Gracias.';
    $notificacionController = new NotificacionController();
    $notificacionController->stnotify($idSC,$message); */
  }

}