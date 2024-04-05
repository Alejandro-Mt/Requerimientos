<?php

namespace App\Http\Controllers;

use App\Mail\Cliente\DefinicionRequerimiento;
use App\Mail\Interno\notificacion_definicion;
use App\Models\analisis;
use App\Models\archivo;
use App\Models\bitacora;
use App\Models\cronograma;
use App\Models\desfase;
use App\Models\informacion;
use App\Models\levantamiento;
use App\Models\planeacion;
use App\Models\registro;
use App\Models\solicitud;
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
        $registros = registro::select('registros.folio', 'registros.id_estatus','p.evidencia as def','l.fecha_def')
          ->leftjoin('levantamientos as l','registros.folio','l.folio')
          ->leftjoin('planeacion as p','registros.folio','p.folio')
          ->where('registros.folio',Crypt::decrypt($folio))->first();
        $id = registro::latest('id_registro')->first();
        $desfases = desfase::all();
        $previo = planeacion::select('*')->where('folio',Crypt::decrypt($folio))->get();
        $vacio = planeacion:: select('*')->where('folio',Crypt::decrypt($folio))->count();
        $solinf = informacion::where('folio',Crypt::decrypt($folio))->whereNULL('respuesta')->count();
        return view('formatos.requerimientos.planeacion',compact('desfases','id','previo','solinf','registros','vacio'));
        #dd($solinf);
        #return $dc;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $data)
    #se comentan las actualizaciones de Calendario
    {
        $registro = levantamiento::select('fechades')->where('folio',$data['folio'])->get();
        if($data['id_estatus'] == NULL){$data['id_estatus'] = 11;}
        else{
            $archivos = Archivo::where('folio', $data['folio'])->get();
            $cliente = solicitud::where('folior', $data['folio'])->select('correo')->first();
            $pip = registro::where('registros.folio', $data['folio'])->leftjoin('responsables as r', 'registros.id_responsable', 'r.id_responsable')->select('email')->first();
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
                            #$data['evidencia'] = mb_strtolower($archivo->url);
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
            if ($pip) {
                $notificacionUserA = Http::get('https://api-seguridadv2.tiii.mx/api/v1/login/validacionRF/0/'.$pip->email);
                $datos = $notificacionUserA->json();
                $idSC = $datos['idUsuario'];
                $message = 'Hola! Te informamos que la definición del requerimiento con folio '.$data->folio.' se ha enviado al cliente para su validación. ~'.route("Archivo",Crypt::encrypt($data->folio)).'~. Gracias.';
                $notificacionController = new NotificacionController();
                $notificacionController->stnotify($idSC,$message);
                Mail::to($pip->email)->send(new notificacion_definicion($data->folio));
            }
            if ($cliente) {
                $notificacionUserA = Http::get('https://api-seguridadv2.tiii.mx/api/v1/login/validacionRF/0/'.$cliente->correo);
                if($notificacionUserA){
                    $datos = $notificacionUserA->json();
                    $idSC = $datos['idUsuario'];
                    $message = 'Hola! Te informamos que la definición del requerimiento con folio '.$data->folio.' se ha enviado a tu correo para su validación. ~'.route("Archivo",Crypt::encrypt($data->folio)).'~. Gracias.';
                    $notificacionController = new NotificacionController();
                    $notificacionController->stnotify($idSC,$message);
                }
                Mail::to($cliente->correo)->send(new DefinicionRequerimiento($data->folio));
            }
        }
        if($data['desfase'] == '1'){
            $this->validate($data, ['motivodesfase' => "required"]);
            $this->validate($data, ['fechareact' => "required|date|after_or_equal:$data[fechaCompReqC]"]);
        }
        $verificar = planeacion::where('folio',$data['folio'])->count();
        if($data['fechaCompReqC']<>NULL){$fechaCompReqC=date("y/m/d H:i:s", strtotime($data['fechaCompReqC']));}else{$fechaCompReqC=NULL;}
        if($data['fechaCompReqR']<>NULL){
            $fechaCompReqR=date("y/m/d H:i:s", strtotime($data['fechaCompReqR']));
        }else{
            $fechaCompReqR=NULL;
        }
        if($data['fechareact']<>NULL){$fechareact=date("y/m/d H:i:s", strtotime($data['fechareact']));}else{$fechareact=NULL;}
        #if($data['id_estatus'] == 9){$this->validate($data, ['fechaCompReqR' => "required|date|after_or_equal:$data[fechaCompReqC]"]);}
        if($verificar == 0){
            planeacion::create([
                'folio' => $data['folio'],
                'fechaCompReqC' => $fechaCompReqC,
                'fechaCompReqR' => $fechaCompReqR,
                'desfase' => $data['desfase'],
                'motivodesfase' => $data['motivodesfase'],
                'motivopausa' => $data['motivopausa'],
                'evpausa' => $data['evpausa'],
                'fechareact' => $fechareact,
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
            $previo = planeacion::select('*')->where('folio',$data['folio'])->get();
            foreach($previo as $fecha){
                if(date('y/m/d', strtotime($fecha->fechaCompReqC)) <> $fechaCompReqC){
                    if(date('y/m/d', strtotime($fecha->fechaCompReqR)) <> $fechaCompReqR){
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
                    if(date('y/m/d', strtotime($fecha->fechaCompReqR)) <> $fechaCompReqR){
                        bitacora::create([
                            'folio'     => $data['folio'],
                            'id_user' => auth::user()->id,
                            'usuario' => auth::user()->fullname,
                            'id_estatus' => '11',
                            'campo' => 'Fecha compromiso real'
                        ]);
                    }
                }
            }
            $update = planeacion::select('*')->where('folio',$data['folio'])->first();
            $update->fechaCompReqC = $fechaCompReqC;
            $update->fechaCompReqR = $fechaCompReqR;
            $update->desfase = $data['desfase'];
            $update->motivodesfase = $data['motivodesfase'];
            $update->motivopausa = $data['motivopausa'];
            $update->evpausa = $data['evpausa'];
            $update->fechareact = $fechareact;
            #$updateP = cronograma::where('folio',$data['folio'])->where('titulo','Definición de requerimientos')->first();
            #$updateP->inicio = $fechaCompReqC;
            #$updateP->fin = $fechaCompReqR;
            #$updateP->save();
            $update->save(); 
        }
        if($data['fechaEnvAn']<>NULL){
            if(analisis::where('folio',$data['folio'])->count() == 0){
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
        $estatus = registro::select()->where('folio', $data->folio)->first();
        $estatus->id_estatus = $data['id_estatus'];
        $estatus->save();
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
    public function show($folio)
    {
        $data['events'] = cronograma::select('titulo as title','inicio as start','fin as end','color as className')->where('folio',$folio)->get();
        return response()->json($data['events']);
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
