<?php

namespace App\Http\Controllers;

use App\Exports\RequerimientosExport;
use App\Mail\Cliente\Fase;
use App\Mail\Interno\NuevoProyecto;
use App\Mail\Interno\Tester;
use App\Models\bitacora;
use App\Models\pausa;
use App\Models\registro;
use App\Models\responsable;
use App\Models\sistema;
use App\Models\solicitud;
use App\Models\solpri;
use App\Models\User;
use App\Models\usr_data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class RecordController extends Controller
{
    protected function index(){
        
        $cliente = db::table('clientes')->orderby('id_cliente', 'asc')->get();
        $datos = null;
        $proyectos = registro::where('folio', 'like', 'PR-PIP%')->get();
        #$id = registro::latest('id_registro')->first();
        $registros = registro::where('folio', 'like', 'PIP%')->count();
        $responsable = User::activos()->orderby('nombre', 'asc')->get();
        $sistema = sistema::all();
        $vacio = registro:: select('*')->count();
        return view('formatos.requerimientos.new',compact('cliente','datos','proyectos','registros','responsable','sistema','vacio'));
        dd($proyectos);
    }

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
            $destino = usr_data::whereIn('id_puesto', [4, 5, 6, 7])->where('id_departamento', '=', 21)->get();
            foreach($destino as $correo){ 
                mail::to($correo->user->email)->send(new NuevoProyecto($data,$correo->nombre));
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
        if($data['preregistro'] != NULL){
            $update = solicitud::where('folio',$data['preregistro'])->first();
            $update->id_estatus= '21';
            $update->folior = $folio;
            $update->save();
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