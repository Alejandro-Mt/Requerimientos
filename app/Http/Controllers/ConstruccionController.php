<?php

namespace App\Http\Controllers;

use App\Mail\Cliente\Fase;
use App\Models\analisis;
use App\Models\bitacora;
use App\Models\construccion;
use App\Models\cronograma;
use App\Models\desfase;
use App\Models\implementacion;
use App\Models\liberacion;
use App\Models\registro;
use App\Models\informacion;
use App\Models\levantamiento;
use App\Models\solicitud;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class ConstruccionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index($folio){
    $registros = registro::select('folio', 'id_estatus')->where('folio',Crypt::decrypt($folio))->first();
    $id = registro::latest('id_registro')->first();
    $desfases = desfase::all();
    $previo = construccion::select('*')->where('folio',Crypt::decrypt($folio))->get();
    $vacio = construccion:: select('*')->where('folio',Crypt::decrypt($folio))->count();
    $solinf = informacion::where('folio',Crypt::decrypt($folio))->whereNULL('respuesta')->count();
    return view('formatos.requerimientos.construccion',compact('registros','id','desfases','previo','vacio','solinf'));
    dd($previo);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(request $data){
    if($data['id_estatus'] == NULL){$data['id_estatus'] = 7;}
    $val = analisis::select('fechaCompReqR')->where('folio',$data['folio'])->get();
    if($data['desfase'] == '1'){
      $this->validate($data, ['motivodesfase' => "required"]);
      $this->validate($data, ['fechareact' => "required|date|after_or_equal:$data[fechaCompReqC]"]);
    }
    foreach($val as $fecha){$this->validate($data, ['fechaInConP' => "required|date|after_or_equal:$fecha->fechaCompReqR"]);}
    $verificar = construccion::where('folio',$data['folio'])->count();
    if($data['fechaInConP']<>NULL){$fechaCompReqC=date("y/m/d H:i:s", strtotime($data['fechaInConP']));}else{$fechaCompReqC=NULL;}
    if($data['fechaInConR']<>NULL){
      if($data['fechaInConP'] <> NULL){
        $this->validate($data, ['fechaInConR' => "required|date|after_or_equal:$data[fechaInConP]"]);
      }
      $fechaCompReqR=date("y/m/d H:i:s", strtotime($data['fechaInConR']));
    }
    else{
      $fechaCompReqR=NULL;
    }
    if($data['fechareact']<>NULL){$fechareact=date("y/m/d H:i:s", strtotime($data['fechareact']));}else{$fechareact=NULL;}
    if($data['id_estatus'] == 8){
      $this->validate($data, ['fechaInConR' => "required|date|after_or_equal:$data[fechaInConP]"]);
      $email = levantamiento::join('solicitantes as s', 's.id_solicitante', '=', 'levantamientos.id_solicitante')
          ->where('folio', $data->folio)
          ->select('s.email')
          ->first();
      $gerencia = User::
            join('puestos as p','p.id_puesto','users.id_puesto')
            ->where('id_area', 6)
            ->whereIn('jerarquia',[4,5])
            ->select('email')
            ->get();
      if($email){
        Mail::to($email->email)->cc($gerencia->pluck('email'))->send(new Fase($data->folio, '8'));
      }
    }
    if($verificar == 0){
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
      $previo = construccion::select('*')->where('folio',$data['folio'])->get();
      foreach($previo as $fecha){
        if(date('y/m/d', strtotime($fecha->fechaCompReqC)) <> $fechaCompReqC){
          if(date('y/m/d', strtotime($fecha->fechaCompReqR)) <> $fechaCompReqR){
            bitacora::create([
              'id_user' => auth::user()->id,
              'usuario' => auth::user()->fullname,
              'id_estatus' => '7',
              'campo' => 'Fechas de construcción actualizadas'
            ]);
          }else{
            bitacora::create([
              'id_user' => auth::user()->id,
              'usuario' => auth::user()->fullname,
              'id_estatus' => '7',
              'campo' => 'Fecha compromiso cliente'
            ]);
          }
        }else{
          if(date('y/m/d', strtotime($fecha->fechaCompReqR)) <> $fechaCompReqR){
            bitacora::create([
              'id_user' => auth::user()->id,
              'usuario' => auth::user()->fullname,
              'id_estatus' => '7',
              'campo' => 'Fecha compromiso real'
            ]);
          }
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
      $estatus = registro::select()-> where ('folio', $data->folio)->first();
      $estatus->id_estatus = $data['id_estatus'];
      $estatus->save();
      $update->save(); 
    } 
    if($data['FechaLibP']<>NULL){
      if(liberacion::where('folio',$data['folio'])->count() == 0){
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
      }/*else{
          $updateL = liberacion::where('folio',$data['folio'])->first();
          $updateL->fecha_lib_a = date("y/m/d H:i:s", strtotime($data['FechaLibP']));
          $updateL->fecha_lib_r = date("y/m/d H:i:s", strtotime($$data['FechaLibR']));
          $update->save();
          $updateCL = cronograma::where('folio',$data['folio'])->orwhere('titulo','Liberación')->first();
          $updateCL->inicio = date('y/m/d',strtotime($data('FechaLibP')));
          $updateCL->fin = date('y/m/d',strtotime($data('FechaLibR')));
          $updateCL->save();
      }*/
    }
    if($data['FechaImpP']<>NULL){
      if(implementacion::where('folio',$data['folio'])->count() == 0){
        cronograma::create([
          'folio' => $data['folio'],
          'titulo' => 'Implementación',
          'inicio' => date("y/m/d H:i:s", strtotime($data['FechaImpP'])),
          'fin' => date("y/m/d H:i:s", strtotime($data['FechaImpP'])),
          'color' => 'bg-primary'
        ]);
        implementacion::create([
          'folio' => $data['folio'],
          'f_implementacion' => date("y/m/d H:i:s", strtotime($data['FechaImpP'])),
        ]);
      }
    }
    $update = registro::select()-> where ('folio', $data->folio)->first();
    $update->id_estatus = $data->input('id_estatus');
    $update->save();
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
