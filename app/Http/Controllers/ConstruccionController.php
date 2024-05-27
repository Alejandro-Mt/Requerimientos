<?php

namespace App\Http\Controllers;

use App\Mail\Cliente\Fase;
use App\Mail\interno\INP;
use App\Models\bitacora;
use App\Models\construccion;
use App\Models\cronograma;
use App\Models\liberacion;
use App\Models\registro;
use App\Models\informacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class ConstruccionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index($folio){
    $registros = registro::where('registros.folio',Crypt::decrypt($folio))->first();
    $solinf = informacion::where('folio',Crypt::decrypt($folio))->whereNULL('respuesta')->count();
    return view('formatos.requerimientos.construccion',compact('registros','solinf'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(request $data){
    $registro = registro::select()-> where ('folio', $data->folio)->first();
    if($data['id_estatus'] == NULL){$data['id_estatus'] = 7;}
    if($data['desfase'] == '1'){
      $this->validate($data, ['motivodesfase' => "required"]);
      $this->validate($data, ['fechareact' => "required|date|after_or_equal:$data[fechaCompReqC]"]);
    }
    $this->validate($data, [
      'fechaInConP' => "required|date|after_or_equal:{$registro->plan->fechaCompReqR}",
    ], [
      'fechaInConP.after_or_equal' => "La fecha de Fecha Compromiso para Entrega debe ser posterior o igual a {$registro->plan->fechaCompReR}",
    ]);
  
    #$this->validate($data, ['fechaInConP' => "required|date|after_or_equal:{$registro->plan->fechaCompReqR}"]);
    if($data['fechaInConP']){$fechaCompReqC=date("y/m/d H:i:s", strtotime($data['fechaInConP']));}else{$fechaCompReqC=NULL;}
    if($data['fechaInConR']){
      if($data['fechaInConP']){
        $this->validate($data, [
          'fechaInConR' => "required|date|after_or_equal:$data[fechaInConP]",
        ], [
          'fechaInConR.after_or_equal' => "La fecha de Fecha Compromiso para Entrega Real debe ser posterior o igual a $data[fechaInConP]",
        ]);
        #$this->validate($data, ['fechaInConR' => "required|date|after_or_equal:$data[fechaInConP]"]);
      }
      $fechaCompReqR=date("y/m/d H:i:s", strtotime($data['fechaInConR']));
    }
    else{
      $fechaCompReqR=NULL;
    }
    if($data['fechareact']){$fechareact=date("y/m/d H:i:s", strtotime($data['fechareact']));}else{$fechareact=NULL;}
    if($data['id_estatus'] == 23){
      $this->validate($data, [
        'fechaInConR' => "required|date|after_or_equal:$data[fechaInConP]",
      ], [
        'fechaInConR.after_or_equal' => "La fecha de Fecha Compromiso para Entrega Real debe ser posterior o igual a $data[fechaInConP]",
      ]);
      $email = $registro->levantamiento->sol->email;
      $coordinacion = User:: select('email')
        ->leftjoin('usr_data as ud', 'id','id_user')
        ->leftjoin('puestos as p','p.id_puesto','ud.id_puesto')
        ->leftjoin('accesos as a','ud.id_user','a.id_user')
        ->whereIn('jerarquia', [2, 3, 7])
        ->where('a.id_sistema',$registro->id_sistema)
        ->get();
      if($email){
        $notificacionUserA = Http::get('https://api-seguridadv2.tiii.mx/api/v1/login/validacionRF/0/'.$email);
        $datos = $notificacionUserA->json();
        $idSC = $datos['idUsuario'];
        $message = 'Hola! Te informamos que el requerimiento con folio '.$data->folio.' ha entrado a la fase de liberación. ~'.route("Archivo",Crypt::encrypt($data->folio)).'~. Gracias.';
        $notificacionController = new NotificacionController();
        $notificacionController->stnotify($idSC,$message);
        //Mail::to($email->email)->cc($gerencia->pluck('email'))->send(new Fase($data->folio, '8'));
        Mail::to($email)->cc($coordinacion->pluck('email'))->send(new Fase($data->folio, '8'));
      }
      if($registro->rtest){
        Mail::to($registro->rtest->email)->send(new INP($data->folio));
      }
    }
    if(!$registro->construccion){
      construccion::create([
        'folio' => $data['folio'],
        'fechaCompReqC' => $fechaCompReqC,
        'evidencia' => $data['evidencia'],
        'fechaCompReqR' => $fechaCompReqR,
        'desfase' => $data['desfase'],
        'motivodesfase' => $data['motivodesfase'],
        'motivopausa' => $data['motivopausa'],
        'evpausa' => $data['evpausa'],
        'fechareact' => $fechareact,
      ]);
      cronograma::create([
        'folio' => $data['folio'],
        'titulo' => 'Construcción',
        'inicio' => $fechaCompReqC,
        'fin' => $fechaCompReqR,
        'color' => 'bg-danger'
      ]);
    }
    else{
      if(date('y/m/d H:i:s', strtotime($registro->construccion->fechaCompReqC)) <> $fechaCompReqC){
        if(date('y/m/d H:i:s', strtotime($registro->construccion->fechaCompReqR)) <> $fechaCompReqR){
          bitacora::create([
            'folio'     => $data['folio'],  'id_user' => auth::user()->id,
            'usuario' => auth::user()->fullname,
            'id_estatus' => '7',
            'campo' => 'Fechas de construcción actualizadas'
          ]);
        }else{
          bitacora::create([
            'folio'     => $data['folio'],  'id_user' => auth::user()->id,
            'usuario' => auth::user()->fullname,
            'id_estatus' => '7',
            'campo' => 'Fecha compromiso cliente'
          ]);
        }
      }else{
        if(date('y/m/d H:i:s', strtotime($registro->construccion->fechaCompReqR)) <> $fechaCompReqR){
          bitacora::create([
            'folio'     => $data['folio'],  'id_user' => auth::user()->id,
            'usuario' => auth::user()->fullname,
            'id_estatus' => '7',
            'campo' => 'Fecha compromiso real'
          ]);
        }
      }
      $update = construccion::select('*')->where('folio',$data['folio'])->first();
      $update->fechaCompReqC = $fechaCompReqC;
      $update->evidencia = $data['evidencia'];
      $update->fechaCompReqR = $fechaCompReqR;
      $update->desfase = $data['desfase'];
      $update->motivodesfase = $data['motivodesfase'];
      $update->motivopausa = $data['motivopausa'];
      $update->evpausa = $data['evpausa'];
      $update->fechareact = $fechareact;
      $update->save(); 
      $registro->id_estatus = $data['id_estatus'];
      $registro->save();
    } 
    if($data['FechaLibP']){
      if(!$registro->liberacion){
        cronograma::create([
          'folio' => $data['folio'],
          'titulo' => 'Liberación',
          'inicio' => date("y/m/d H:i:s", strtotime($data['FechaLibP'])),
          'fin' => date("y/m/d H:i:s", strtotime($data['FechaLibR'])),
          'color' => 'bg-warning'
        ]);
        liberacion::create([
          'folio' => $data['folio'],
          'fecha_lib_a' => date("y/m/d H:i:s", strtotime($data['FechaLibP'])),
          'evidencia' => 'null',
          'fecha_lib_r' => date("y/m/d H:i:s", strtotime($data['FechaLibR'])),
        ]);
      }
    }
    $registro->id_estatus = $data->input('id_estatus');
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
