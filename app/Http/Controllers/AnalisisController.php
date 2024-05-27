<?php

namespace App\Http\Controllers;

use App\Mail\Cliente\Fase;
use App\Models\analisis;
use App\Models\bitacora;
use App\Models\informacion;
use App\Models\registro;
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
        $registros = registro::where('folio',Crypt::decrypt($folio))->first();
        $solinf = informacion::where('folio',Crypt::decrypt($folio))->whereNULL('respuesta')->count();
        return view('formatos.requerimientos.analisis',compact('registros','solinf'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $data){
        $registro = registro::select()-> where ('folio', $data->folio)->first();
        if($data['id_estatus'] == NULL){
            $data['id_estatus'] = 9;
        }else{
            $archivos = $registro->archivos;
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
        if($data['desfase'] == '1'){
            $this->validate($data, ['motivodesfase' => "required"]);
            $this->validate($data, ['fechareact' => "required|date|after_or_equal:$data[fechaCompReqC]"]);
        }
        $this->validate($data, [
            'fechaCompReqC' => "required|date|after_or_equal:{$registro->defReq->fechaCompReqR}",
        ], [
            "fechaCompReqC.after_or_equal' => 'El campo Fecha Compromiso para Entrega debe ser una fecha posterior o igual a {$registro->defReq->fechaCompReqR}",
        ]);
        
        if($data['fechaCompReqC']){$fechaCompReqC=date("y/m/d H:i:s", strtotime($data['fechaCompReqC']));}else{$fechaCompReqC=NULL;}
        if($data['fechaCompReqR']){
            if($data['fechaCompReqC']){
                $this->validate($data, ['fechaCompReqR' => "required|date|after_or_equal:$data[fechaCompReqC]"]);
            }
            $fechaCompReqR=date("y/m/d H:i:s", strtotime($data['fechaCompReqR']));}
        else{
            $fechaCompReqR=NULL;
        }
        if($data['fechareact']<>NULL){$fechareact=date("y/m/d H:i:s", strtotime($data['fechareact']));}else{$fechareact=NULL;}
        if($data['id_estatus'] == 7){
            $this->validate($data, ['fechaCompReqR' => "required|date|after_or_equal:$data[fechaCompReqC]"]);
            $email = $registro->levantamiento->sol->email;
            $coordinacion = User:: select('email')
              ->leftjoin('usr_data as ud', 'id','id_user')
              ->leftjoin('puestos as p','p.id_puesto','ud.id_puesto')
              ->leftjoin('accesos as a','ud.id_user','a.id_user')
              ->whereIn('jerarquia', [2, 3, 7])
              ->where('a.id_sistema',$registro->id_sistema)
              ->get();
            $notificacionUserA = Http::get('https://api-seguridadv2.tiii.mx/api/v1/login/validacionRF/0/'.$email);
            $datos = $notificacionUserA->json();
            $idSC = $datos['idUsuario'];
            $message = 'Hola! Te informamos que el requerimiento con folio '.$data->folio.' ha entrado a la fase de construcción. ~'.route("Archivo",Crypt::encrypt($data->folio)).'~. Gracias.';
            $notificacionController = new NotificacionController();
            $notificacionController->stnotify($idSC,$message);
            if($email){
                Mail::to($email)->cc($coordinacion->pluck('email'))->send(new Fase($data->folio, '7'));
            }
        }
        if(!$registro->plan){
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
            if(date('y/m/d H:i:s', strtotime($registro->plan->fechaCompReqC)) <> $fechaCompReqC){
                if(date('y/m/d H:i:s', strtotime($registro->plan->fechaCompReqR)) <> $fechaCompReqR){
                    bitacora::create([
                        'folio'     => $data['folio'],
                        'id_user' => auth::user()->id,
                        'usuario' => auth::user()->fullname,
                        'id_estatus' => '9',
                        'campo' => 'Fechas de análisis actualizadas'
                    ]);
                }else{
                    bitacora::create([
                        'folio'     => $data['folio'],
                        'id_user' => auth::user()->id,
                        'usuario' => auth::user()->fullname,
                        'id_estatus' => '9',
                        'campo' => 'Fecha compromiso cliente'
                    ]);
                }
            }else{
                if(date('y/m/d H:i:s', strtotime($registro->plan->fechaCompReqR)) <> $fechaCompReqR){
                    bitacora::create([
                        'folio'     => $data['folio'],
                        'id_user' => auth::user()->id,
                        'usuario' => auth::user()->fullname,
                        'id_estatus' => '9',
                        'campo' => 'Fecha compromiso real'
                    ]);
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
        $registro->id_estatus = $data['id_estatus'];
        $registro->save();
        return redirect(route('Documentos',Crypt::encrypt($data['folio'])));
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
