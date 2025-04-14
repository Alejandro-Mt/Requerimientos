<?php

namespace App\Http\Controllers;

use App\Mail\Cliente\DefinicionRequerimiento;
use App\Mail\Interno\Aut_f;
use App\Mail\Interno\N_Flujo;
use App\Mail\Interno\notificacion_definicion;
use App\Models\analisis;
use App\Models\archivo;
use App\Models\bitacora;
use App\Models\cronograma;
use App\Models\gatt;
use App\Models\informacion;
use App\Models\planeacion;
use App\Models\registro;
use App\Models\solicitud;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PlaneacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($folio)
    {
        $registros = registro::where('folio',Crypt::decrypt($folio))->first();
        $solinf = informacion::where('folio',Crypt::decrypt($folio))->whereNULL('respuesta')->count();
        return view('formatos.requerimientos.planeacion',compact('solinf','registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $data)
    #se comentan las actualizaciones de Calendario
    {
        $registro = registro::where('registros.folio', $data['folio'])->first();
        if($data['id_estatus'] == NULL){$data['id_estatus'] = 11;}
        else{
            $archivos = $registro->archivos;
            $requiredKeywords = ['definición de requerimiento', 'flujo de trabajo', 'mockup'];
            $missingKeywords = [];
            $definicionRequerimientoFound = false;

            foreach ($requiredKeywords as $requiredKeyword) {
                $keywordFound = false;
                foreach ($archivos as $archivo) {
                    $archivoUrl = mb_strtolower($archivo->url);
                    if (str_contains($archivoUrl, $requiredKeyword)) {
                        $keywordFound = true;
                        if ($requiredKeyword == 'definición de requerimiento') {
                            $definicionRequerimientoFound = true;
                        } elseif ($requiredKeyword == 'flujo de trabajo' || $requiredKeyword == 'mockup') {
                            $flujoTrabajoOrMockupFound = true;
                        }
                        break;
                    }
                }

                if (!$keywordFound) {
                    $missingKeywords[] = mb_strtoupper($requiredKeyword);
                }
            }
            if (!$definicionRequerimientoFound) {
                // "definición de requerimiento" es obligatoria, por lo que si no se encuentra, muestra un error
                $errorMessage = "No se ha adjuntado el archivo: definición de requerimiento";
                Session::flash('error', $errorMessage);
                return redirect()->back();
            }
            if ($registro->rpip) {
                #$notificacionUserA = Http::get('https://api-seguridadv2.tiii.mx/api/v1/login/validacionRF/0/'.$registro->rpip->email);
                $notificacionUserA = Http::get('https://api-seguridad-67vdh6ftzq-uc.a.run.app/api/v1/login/validacionRF/0/' . $registro->rpip->email);
                $datos = $notificacionUserA->json();
                $idSC = $datos['idUsuario'];
                $message = 'Hola! Te informamos que la definición del requerimiento con folio '.$data->folio.' se ha enviado al cliente para su validación. ~'.route("Archivo",Crypt::encrypt($data->folio)).'~. Gracias.';
                $notificacionController = new NotificacionController();
                $notificacionController->stnotify($idSC,$message);
                Mail::to($registro->rpip->email)->send(new notificacion_definicion($data->folio));
            }
            /*if ($registro->solicitud) {
                #$notificacionUserA = Http::get('https://api-seguridadv2.tiii.mx/api/v1/login/validacionRF/0/'.$registro->solicitud->correo);
                $notificacionUserA = Http::get('https://api-seguridad-67vdh6ftzq-uc.a.run.app/api/v1/login/validacionRF/0/' . $registro->solicitud->correo);
                if($notificacionUserA){
                    $datos = $notificacionUserA->json();
                    $idSC = $datos['idUsuario'];
                    $message = 'Hola! Te informamos que la definición del requerimiento con folio '.$data->folio.' se ha enviado a tu correo para su validación. ~'.route("Archivo",Crypt::encrypt($data->folio)).'~. Gracias.';
                    $notificacionController = new NotificacionController();
                    $notificacionController->stnotify($idSC,$message);
                }
                Mail::to($registro->solicitud->correo)->send(new DefinicionRequerimiento($data->folio));
            }*/
        }
        if($data['desfase'] == '1'){
            $this->validate($data, ['motivodesfase' => "required"]);
            $this->validate($data, ['fechareact' => "required|date|after_or_equal:$data[fechaCompReqC]"]);
        }
        if($data['fechaCompReqC']){$fechaCompReqC=date("y/m/d H:i:s", strtotime($data['fechaCompReqC']));}else{$fechaCompReqC=NULL;}
        if($data['fechaCompReqR']){$fechaCompReqR=date("y/m/d H:i:s", strtotime($data['fechaCompReqR']));}else{$fechaCompReqR=NULL;}
        if(!$registro->defReq){
            planeacion::create([
                'folio' => $data['folio'],
                'fechaCompReqC' => $fechaCompReqC,
                'fechaCompReqR' => $fechaCompReqR,
                'desfase' => $data['desfase'],
                'motivodesfase' => $data['motivodesfase'],
                'motivopausa' => $data['motivopausa'],
                'evpausa' => $data['evpausa']
            ]);
            cronograma::create([
                'folio' => $data['folio'],
                'titulo' => 'Definición de requerimientos',
                'inicio' => $fechaCompReqC,
                'fin' => $fechaCompReqR,
                'color' => 'bg-info'
            ]);
        }
        else{
            if(date('y/m/d H:i:s', strtotime($registro->defReq->fechaCompReqC)) <> $fechaCompReqC){
                if(date('y/m/d H:i:s', strtotime($registro->defReq->fechaCompReqR)) <> $fechaCompReqR){
                    bitacora::create([
                        'folio'     => $data['folio'],
                        'id_user' => auth::user()->id,
                        'usuario' => auth::user()->fullname,
                        'id_estatus' => '11',
                        'campo' => 'Fechas de planeación actualizadas'
                    ]);
                }else{
                    bitacora::create([
                        'folio'     => $data['folio'],
                        'id_user' => auth::user()->id,
                        'usuario' => auth::user()->fullname,
                        'id_estatus' => '11',
                        'campo' => 'Fecha compromiso cliente'
                    ]);
                }
            }else{
                if(date('y/m/d H:i:s', strtotime($registro->defReq->fechaCompReqR)) <> $fechaCompReqR){
                    bitacora::create([
                        'folio'     => $data['folio'],
                        'id_user' => auth::user()->id,
                        'usuario' => auth::user()->fullname,
                        'id_estatus' => '11',
                        'campo' => 'Fecha compromiso real'
                    ]);
                }
            }
            $update = planeacion::select('*')->where('folio',$data['folio'])->first();
            $update->fechaCompReqC = $fechaCompReqC;
            $update->fechaCompReqR = $fechaCompReqR;
            $update->desfase = $data['desfase'];
            $update->motivodesfase = $data['motivodesfase'];
            $update->motivopausa = $data['motivopausa'];
            $update->evpausa = $data['evpausa'];
            $update->save(); 
        }
        if($data['fechaEnvAn']<>NULL){
            if(!$registro->plan){
                cronograma::create([
                    'folio' => $data['folio'],
                    'titulo' => 'Analisis de requerimientos',
                    'inicio' => date("y/m/d H:i:s", strtotime($data['fechaEnvAn'])),
                    'fin' => date("y/m/d H:i:s", strtotime($data['fechaAutAn'])),
                    'color' => 'bg-success'
                ]);
                analisis::create([
                    'folio' => $data['folio'],
                    'fechaCompReqC' => date("y/m/d H:i:s", strtotime($data['fechaEnvAn'])),
                    'evidencia' => 'null',
                    'fechaCompReqR' => date("y/m/d H:i:s", strtotime($data['fechaAutAn'])),
                ]);
            }
        }
        $registro->id_estatus = $data['id_estatus'];
        $registro->save();
        return redirect(route('Documentos',Crypt::encrypt($data['folio'])));
        #dd($destino->correo);
    }

    /**
     * Store a newly created notify.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function notify($folio)
    {
        //
        $destino = solicitud::where('folior', $folio)->select('correo')->first();
        if ($destino) {
            // Envía el correo si se cumple la condición
            Mail::to($destino->correo)->send(new DefinicionRequerimiento($folio));
        }
        return redirect(route('Documentos',Crypt::encrypt($folio)));
    }

 /* public function nflujo($folio){
    $registro       = registro::where('folio',$folio)->first();
    $user           = User::findOrFAil(Auth::user()->id);
    $validar        = Archivo::where('folio', $folio)
      ->where(function ($query) {
        $query->where('url', 'like', '%flujo%')->orWhere('url', 'like', '%prototipo%');
      })
      ->first();
    $campo      = 
      bitacora::create([
        'folio'         => $folio,
        'usuario'       => $user->getFullnameAttribute(),
        'id_user'       => $user->id,
        'campo'         => "Se envió definición de requerimiento a cliente",
        'id_estatus'    => $registro->id_estatus,
      ]);
    if ($registro->solicitud && $validar) {
      $notificacionUserA = Http::get('https://api-seguridad-67vdh6ftzq-uc.a.run.app/api/v1/login/validacionRF/0/' . $registro->solicitud->correo);
      if($notificacionUserA){
        $datos = $notificacionUserA->json();
        $idSC = $datos['idUsuario'];
        $message = 'Hola! Te informamos que la definición del requerimiento con folio '.$registro->folio.' se ha enviado a tu correo para su validación. ~'.route("Archivo",Crypt::encrypt($registro->folio)).'~. Gracias.';
        $notificacionController = new NotificacionController();
        $notificacionController->stnotify($idSC,$message);
      }
      Mail::to($registro->solicitud->correo)->send(new DefinicionRequerimiento($registro->folio));
      $registro->id_estatus = 11; 
      $registro->save();
    }
    return redirect(route('Documentos',Crypt::encrypt($folio)))->with('fail', 'Se necesita archivo para avanzar');
  }*/
  
  public function rflujo($folio, $respuesta){
    $registro       = registro::where('folio',$folio)->first();
    $user           = User::findOrFAil(Auth::user()->id);
    if ($registro->solicitud && $respuesta  == 1) {
      bitacora::create([
        'folio'         => $folio,
        'usuario'       => $user->getFullnameAttribute(),
        'id_user'       => $user->id,
        'campo'         => "Se envió definición de requerimiento a cliente",
        'id_estatus'    => $registro->id_estatus,
      ]);
      $registro->id_estatus = 9; 
      $registro->save();
      $notificacionUserA = Http::get('https://api-seguridad-67vdh6ftzq-uc.a.run.app/api/v1/login/validacionRF/0/' . $registro->solicitud->correo);
      if($notificacionUserA){
        $datos = $notificacionUserA->json();
        $idSC = $datos['idUsuario'];
        $message = 'Hola! Te informamos que la definición del requerimiento con folio '.$registro->folio.' se ha enviado a tu correo para su validación. ~'.route("Archivo",Crypt::encrypt($registro->folio)).'~. Gracias.';
        $notificacionController = new NotificacionController();
        $notificacionController->stnotify($idSC,$message);
      }
      Mail::to($registro->solicitud->correo)->send(new DefinicionRequerimiento($registro->folio));
      Mail::to($registro->rpip->email)->send(new Aut_f ($registro->folio, $respuesta));
      return redirect(route('Documentos',Crypt::encrypt($folio)))->with('success', 'Enviado');
    }
    elseif ($registro->solicitud && $respuesta  == 0){
      bitacora::create([
        'folio'         => $folio,
        'usuario'       => $user->getFullnameAttribute(),
        'id_user'       => $user->id,
        'campo'         => "Flujo no aceptado por Desarrollo",
        'id_estatus'    => $registro->id_estatus,
      ]);
      $notificacionUserA = Http::get('https://api-seguridad-67vdh6ftzq-uc.a.run.app/api/v1/login/validacionRF/0/' . $registro->rpip->email);
      if($notificacionUserA){
        $datos = $notificacionUserA->json();
        $idSC = $datos['idUsuario'];
        $message = 'Hola! Te informamos que desarrollo rechazo el flujo del requerimiento con folio '.$registro->folio.'. ~'.route("Archivo",Crypt::encrypt($registro->folio)).'~. Gracias.';
        $notificacionController = new NotificacionController();
        $notificacionController->stnotify($idSC,$message);
      }
      Mail::to($registro->rpip->email)->send(new Aut_f ($registro->folio, $respuesta));
      return redirect(route('Documentos',Crypt::encrypt($folio)))->with('fail', 'Se necesita archivo para avanzar');
    }
  }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($folio){
        $events = gatt::where('folio', $folio)->with('estatus')->get();

        $data = $events->map(function ($event) {
            return [
                'title' => $event->estatus->titulo, // Accedes a la relación y extraes el campo 'titulo' de la tabla relacionada
                'start' => $event->fecha_inicio,
                'end' => $event->fecha_fin,
                'className' => $event->estatus->color,
            ];
        });
        
        return response()->json($data);
    }

    public function start($folio)
    {
        $reg = registro::where('folio',$folio)->first();
        $data['start'] = $reg->solicitud->created_at ?? $reg->created_at;

        // Combinar los datos del cronograma y la fecha de levantamiento

        return response()->json($data['start']);
    }

    public function range($folio)
    {
        $data['start'] = 
        DB::table('levantamientos')
        ->select(DB::raw('DATE(fechaaut) as start'))
        ->where('folio', $folio)
        ->first();

        // Combinar los datos del cronograma y la fecha de levantamiento

        return response()->json($data['start']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data)
    {
        //validar datos
        $this->validate($data, [
            'evidencia' => 'required'
        ]);
        $verificar = planeacion::where('folio',$data['folio'])->count();
        if($verificar == 0){
            planeacion::create([
                'folio' => $data['folio'],
                'evidencia' => $data['evidencia']
            ]);
        }
        else{
            $update = planeacion::where('folio',$data['folio'])->first();
            $update->evidencia = $data['evidencia'];
            $update->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
