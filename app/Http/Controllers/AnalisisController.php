<?php

namespace App\Http\Controllers;

use App\Mail\Cliente\Fase;
use App\Models\analisis;
use App\Models\archivo;
use App\Models\bitacora;
use App\Models\desfase;
use App\Models\informacion;
use App\Models\levantamiento;
use App\Models\planeacion;
use App\Models\puesto;
use App\Models\registro;
use App\Models\solicitud;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AnalisisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($folio){
        $registros = registro::select('registros.folio', 'id_estatus','p.evidencia as def','l.fecha_def')
          ->leftjoin('levantamientos as l','registros.folio','l.folio')
          ->leftjoin('planeacion as p','registros.folio','p.folio')
          ->where('registros.folio',Crypt::decrypt($folio))->first();
        $id = registro::latest('id_registro')->first();
        $desfases = desfase::all();
        $previo = analisis::select('*')->where('folio',Crypt::decrypt($folio))->get();
        $vacio = analisis:: select('*')->where('folio',Crypt::decrypt($folio))->count();
        $solinf = informacion::where('folio',Crypt::decrypt($folio))->whereNULL('respuesta')->count();
        return view('formatos.requerimientos.analisis',compact('registros','id','desfases','previo','vacio','solinf'));
        #dd($solinf);
        #dd($previo);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $data){
        $estatus = registro::select()-> where ('folio', $data->folio)->first();
        if($data['id_estatus'] == NULL){
            $data['id_estatus'] = 9;
        }else{
            $archivos = Archivo::where('folio', $data['folio'])->get();
            $requiredKeywords = ['plan de trabajo'];
            $foundKeywords = [];
            foreach ($requiredKeywords as $requiredKeyword) {
                foreach ($archivos as $archivo) {
                    $archivoUrl = mb_strtolower($archivo->url);
                    if (str_contains($archivoUrl, $requiredKeyword)) {
                        $foundKeywords[] = mb_strtoupper($requiredKeyword);
                        break; // Si se encuentra una palabra clave, no es necesario seguir buscando en los archivos.
                    }
                }
            }
            if (empty($foundKeywords)) {
                // Ninguna de las palabras clave requeridas está presente en los archivos.
                $errorMessage = "No se ha cargado: " . implode(', ', $requiredKeywords);
                Session::flash('error', $errorMessage);
                return redirect()->back();
            }

        }
        $val = planeacion::select('fechaCompReqR')->where('folio',$data['folio'])->get();
        if($data['desfase'] == '1'){
            $this->validate($data, ['motivodesfase' => "required"]);
            $this->validate($data, ['fechareact' => "required|date|after_or_equal:$data[fechaCompReqC]"]);
        }
        foreach($val as $fecha){$this->validate($data, ['fechaCompReqC' => "required|date|after_or_equal:$fecha->fechaCompReqR"]);}
        $verificar = analisis::where('folio',$data['folio'])->count();
        if($data['fechaCompReqC']<>NULL){$fechaCompReqC=date("y/m/d", strtotime($data['fechaCompReqC']));}else{$fechaCompReqC=NULL;}
        if($data['fechaCompReqR']<>NULL){
            if($data['fechaCompReqC'] <> NULL){
                $this->validate($data, ['fechaCompReqR' => "required|date|after_or_equal:$data[fechaCompReqC]"]);
            }
            $fechaCompReqR=date("y/m/d", strtotime($data['fechaCompReqR']));}
        else{
            $fechaCompReqR=NULL;
        }
        if($data['fechareact']<>NULL){$fechareact=date("y/m/d", strtotime($data['fechareact']));}else{$fechareact=NULL;}
        if($data['id_estatus'] == 7){
            $this->validate($data, ['fechaCompReqR' => "required|date|after_or_equal:$data[fechaCompReqC]"]);
            $email = levantamiento::join('solicitantes as s', 's.id_solicitante', '=', 'levantamientos.id_solicitante')
                ->where('folio', $data->folio)
                ->select('s.email')
                ->first();
            /*$gerencia = User::
                join('puestos as p','p.id_puesto','users.id_puesto')
                ->where('id_area', 6)
                ->whereIn('jerarquia',[4,5])
                ->select('email')
                ->get();*/
            $coordinacion = User:: select('email')
                ->leftjoin('puestos as p','p.id_puesto','users.id_puesto')
                ->leftjoin('accesos as a','users.id','a.id_user')
                ->whereIn('jerarquia', [2, 3, 7])
                ->where('a.id_sistema',$estatus->id_sistema)
                ->where('id_area', 6)
                ->get();
            $notificacionUserA = Http::get('https://api-seguridadv2.tiii.mx/api/v1/login/validacionRF/0/'.$email->email);
            $datos = $notificacionUserA->json();
            $idSC = $datos['idUsuario'];
            $message = 'Hola! Te informamos que el requerimiento con folio '.$data->folio.' ha entrado a la fase de construcción. ~'.route("Archivo",Crypt::encrypt($data->folio)).'~. Gracias.';
            $notificacionController = new NotificacionController();
            $notificacionController->stnotify($idSC,$message);
            if($email){
                Mail::to($email->email)->cc($coordinacion->pluck('email'))->send(new Fase($data->folio, '7'));
            }
        }
        if($verificar == 0){
            analisis::create([
            'folio' => $data['folio'],
            'fechaCompReqC' =>$fechaCompReqC,
            'evidencia' => $data['evidencia'],
            'fechaCompReqR' => $fechaCompReqR,
            'desfase' => $data['desfase'],
            'motivodesfase' => $data['motivodesfase'],
            'motivopausa' => $data['motivopausa'],
            'evpausa' => $data['evpausa'],
            'fechareact' => $fechareact,
            ]);
        }
        else{
            $previo = analisis::select('*')->where('folio',$data['folio'])->get();
            foreach($previo as $fecha){
                if(date('y/m/d', strtotime($fecha->fechaCompReqC)) <> $fechaCompReqC){
                    if(date('y/m/d', strtotime($fecha->fechaCompReqR)) <> $fechaCompReqR){
                        bitacora::create([
                            'id_user' => auth::user()->id,
                            'usuario' => auth::user()->fullname,
                            'id_estatus' => '9',
                            'campo' => 'Fechas de análisis actualizadas'
                        ]);
                    }else{
                        bitacora::create([
                            'id_user' => auth::user()->id,
                            'usuario' => auth::user()->fullname,
                            'id_estatus' => '9',
                            'campo' => 'Fecha compromiso cliente'
                        ]);
                    }
                }else{
                    if(date('y/m/d', strtotime($fecha->fechaCompReqR)) <> $fechaCompReqR){
                        bitacora::create([
                            'id_user' => auth::user()->id,
                            'usuario' => auth::user()->fullname,
                            'id_estatus' => '9',
                            'campo' => 'Fecha compromiso real'
                        ]);
                    }
                }
            }
            $update = analisis::select('*')->where('folio',$data['folio'])->first();
            $update->fechaCompReqC = $fechaCompReqC;
            $update->evidencia = $data['evidencia'];
            $update->fechaCompReqR = $fechaCompReqR;
            $update->desfase = $data['desfase'];
            $update->motivodesfase = $data['motivodesfase'];
            $update->motivopausa = $data['motivopausa'];
            $update->evpausa = $data['evpausa'];
            $update->fechareact = $fechareact;
            $update->save(); 
        }
        $estatus->id_estatus = $data['id_estatus'];
        $estatus->save();
        return redirect(route('Documentos',Crypt::encrypt($data['folio'])));
        #dd($data->id_estatus);
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
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
