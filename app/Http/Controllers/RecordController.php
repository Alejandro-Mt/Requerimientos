<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
=======
use App\Exports\RequerimientosExport;
>>>>>>> versionprod
use App\Mail\Cliente\Fase;
use App\Mail\Interno\NuevoProyecto;
use App\Mail\Interno\Tester;
use App\Models\bitacora;
<<<<<<< HEAD
use App\Models\levantamiento;
=======
use App\Models\pausa;
>>>>>>> versionprod
use App\Models\registro;
use App\Models\responsable;
use App\Models\sistema;
use App\Models\solicitud;
use App\Models\solpri;
use App\Models\User;
<<<<<<< HEAD
=======
use App\Models\usr_data;
>>>>>>> versionprod
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use DateTime;
<<<<<<< HEAD
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
=======
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
>>>>>>> versionprod

class RecordController extends Controller
{
    protected function index(){
        
        $cliente = db::table('clientes')->orderby('id_cliente', 'asc')->get();
        $datos = null;
        $proyectos = registro::where('folio', 'like', 'PR-PIP%')->get();
        #$id = registro::latest('id_registro')->first();
        $registros = registro::where('folio', 'like', 'PIP%')->count();
<<<<<<< HEAD
        $responsable = User::orderby('nombre', 'asc')->get();
=======
        $responsable = User::activos()->orderby('nombre', 'asc')->get();
>>>>>>> versionprod
        $sistema = sistema::all();
        $vacio = registro:: select('*')->count();
        return view('formatos.requerimientos.new',compact('cliente','datos','proyectos','registros','responsable','sistema','vacio'));
        dd($proyectos);
    }

<<<<<<< HEAD
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

=======
>>>>>>> versionprod
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
<<<<<<< HEAD
            $destino = 
                db::
                    table('users as u')->
                    where('u.id_puesto','>',5)->get();
            foreach($destino as $correo){ 
                mail::to($correo->email)->send(new NuevoProyecto($data,$correo->nombre));
=======
            $destino = usr_data::whereIn('id_puesto', [4, 5, 6, 7])->where('id_departamento', '=', 21)->get();
            foreach($destino as $correo){ 
                mail::to($correo->user->email)->send(new NuevoProyecto($data,$correo->nombre));
>>>>>>> versionprod
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
<<<<<<< HEAD
=======
        if($data['preregistro'] != NULL){
            $update = solicitud::where('folio',$data['preregistro'])->first();
            $update->id_estatus= '21';
            $update->folior = $folio;
            $update->save();
        }
>>>>>>> versionprod
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
<<<<<<< HEAD
        if($data['preregistro'] != NULL){
            $update = solicitud::where('folio',$data['preregistro'])->first();
            $update->id_estatus= '21';
            $update->folior = $folio;
            $update->save();
        }
=======
>>>>>>> versionprod
        $listado = solpri::where([['estatus', 'autorizado'],['id_cliente',$data['id_cliente']]])->orderby('id','desc')->first();
        if(($listado) != NULL){
            $listado->orden = $listado->orden.','.$folio;
            $listado->save();
        }
        $notificacionSCC = solicitud::where('folio',$data['preregistro'])->first();
        #$notificacionUser = Http::get('https://api-seguridadv2.tiii.mx/api/v1/login/validacionRF/0/'.$notificacionSCC->correo);
        $notificacionUser = Http::get('https://api-seguridad-67vdh6ftzq-uc.a.run.app/api/v1/login/validacionRF/0/' . $notificacionSCC->correo);
        $datos = $notificacionUser->json();
        $idSC = $datos['idUsuario'];
        $message = 'Hola! Te informamos que tu solicitud de requerimiento ha sido asignada con el folio '.$folio.'. En la siguiente liga encontraras mas información ~https://requerimientos.tiii.mx/preregistro.listado~. Gracias.';
        #dd($idSC,$message);
        $notificacionController = new NotificacionController();
        $notificacionController->stnotify($idSC,$message);
        #dd(($folio));
        return redirect(route('Nuevo'))->with('alert', $folio);
    }
<<<<<<< HEAD
    
    public function update(Request $data, $folio)
    {
        $registro = registro::where('folio',$folio)->first();
        $registro->id_estatus= 14;
        $registro->motivo_can_id = $data['motivo'];
        $email = levantamiento::join('users as s', 's.id', '=', 'levantamientos.id_solicitante')
            ->where('folio', $folio)
            ->select('s.email')
            ->first();
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
=======

    public function update(Request $data, $folio)
    {
        $update = registro::where('folio',$folio)->first();
        $update->descripcion = $data['descripcion'];
        $update->id_responsable = $data['id_responsable'];
        $update->id_sistema = $data['id_sistema'];
        $update->id_cliente = $data['id_cliente'];
        $update->id_arquitecto = $data['id_arquitecto'];
        $update->es_proyecto = $data['es_pr'];
        $update->folio_pr = $data['folio_pr'];
        $update->es_emergente = $data['es_em'];
        $update->save();  
        return redirect(route('Documentos',Crypt::encrypt($folio)));
    }
    
    public function cancel(Request $data, $folio)
    {
        $registro = registro::where('folio',$folio)->first();
        if($registro->pausado){
            $reaunudar = pausa::select('*')->where('folio', $folio)->orderby('created_at','desc')->first();
            $reaunudar->pausa = '0';
            $reaunudar->save();
        }
        $registro->id_estatus= 14;
        $registro->motivo_can_id = $data['motivo'];
        if($registro->levantamiento){
            $involucrados = $registro->levantamiento->involucrados($folio);
            if($involucrados){
                Mail::to($registro->levantamiento->sol->email)->cc($involucrados->pluck('email'))->send(new Fase($folio,'14'));
            }
        }
        $registro->save();
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
        #Mail::to($registro->rtest->email)->send(new Tester($folio));
        return redirect(route('Documentos',Crypt::encrypt($folio)));
        ####  Notificaciones por ST desactivadas  ###
        /*$notificacionUserC = Http::get('https://api-seguridadv2.tiii.mx/api/v1/login/validacionRF/0/'.$correo->rpip->email);
        $datos = $notificacionUserC->json();
        $idSC = $datos['idUsuario'];
        $message = 'Hola! Te informamos que desarrollo ha designado la clase del requerimiento con folio '.$folio. '. ~'.route("Documentos",Crypt::encrypt($folio)).'~.  Gracias.';
        $notificacionController = new NotificacionController();
        $notificacionController->stnotify($idSC,$message); */
    }

    public function report(Request $data)
    {
        // Obtener los valores de los parámetros directamente del Request.
        $sistema     = $this->getImplodedParam($data, 'id_sistema');
        $cliente     = $this->getImplodedParam($data, 'id_cliente');
        $estatus     = $this->getImplodedParam($data, 'estado');
        $responsable = $this->getImplodedParam($data, 'id_responsable');
        $fecha_inicio = $this->getImplodedParam($data, 'fecha_inicio');
        $fecha_fin    = $this->getImplodedParam($data, 'fecha_fin');

        // Llamada al procedimiento almacenado
        $result = DB::select('
            CALL sp_GetRegistros(:cliente, :sistema, :estatus, :responsable, :fecha_inicio, :fecha_fin)', 
            [
                'cliente' => $cliente, 
                'sistema' => $sistema, 
                'estatus' => $estatus, 
                'responsable' => $responsable, 
                'fecha_inicio' => $fecha_inicio, 
                'fecha_fin' => $fecha_fin
            ]
        );
        $result = array_map(function ($item) {
            $item = (array) $item; // por si viene como stdClass
            return array_map(function ($value) {
                return is_string($value) ? mb_strtoupper($value, 'UTF-8') : $value;
            }, $item);
        }, $result);
        // Puedes devolver el resultado o hacer lo que necesites con él
        return Excel::download(new RequerimientosExport($result), 'REPORTE DE REQUERIMIENTOS.xlsx');
        //return response()->json($result);
    }
    
    function getImplodedParam($data, $key)
    {
        $value = $data->get($key);
        return is_array($value) ? implode(',', $value) : $value;
    }
}
>>>>>>> versionprod
