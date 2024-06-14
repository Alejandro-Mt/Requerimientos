<?php

namespace App\Http\Controllers;

use App\Mail\Cliente\Fase;
use App\Models\archivo;
use App\Models\implementacion;
use App\Models\levantamiento;
use App\Models\liberacion;
use App\Models\registro;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ImplementacionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index($folio){
    $desfases = db::table('estatus_funcionalidad')->select('*')->get();
    $registros = registro::where('registros.folio',Crypt::decrypt($folio))->first();
    return view('formatos.requerimientos.implementacion',compact('desfases','registros'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(request $data){ 
    $estatus = registro::where('folio', $data->folio)->first();
    if($data['id_estatus'] == NULL){$data['id_estatus'] = 2;}
    else{
      $archivos = Archivo::where('folio', $data['folio'])->get();
      $requiredKeywords = ['acta de cierre'];
      $missingKeywords = [];
      foreach ($requiredKeywords as $requiredKeyword) {
          $keywordFound = false;
          foreach ($archivos as $archivo) {
              if (str_contains(mb_strtolower($archivo->url), $requiredKeyword)) {
                  $keywordFound = true;
                  break;
              }
          }
          if (!$keywordFound) {
              $missingKeywords[] = mb_strtoupper($requiredKeyword);
          }
      }
      if (!empty($missingKeywords)) {
          // Al menos un archivo requerido no contiene las palabras clave
          $errorMessage = "No se ha adjuntado el archivo: " . implode(', ', $missingKeywords);
          Session::flash('error', $errorMessage);
          return redirect()->back();
      }
      $email = $estatus->levantamiento->sol->email;
      $coordinacion = User:: select('email')
          ->leftjoin('puestos as p','p.id_puesto','users.id_puesto')
          ->leftjoin('accesos as a','users.id','a.id_user')
          ->whereIn('jerarquia', [2, 3, 7])
          ->where('a.id_sistema',$estatus->id_sistema)
          ->where('id_area', 6)
          ->get();
      if($email){
        $notificacionUserA = Http::get('https://api-seguridadv2.tiii.mx/api/v1/login/validacionRF/0/'.$email);
        $datos = $notificacionUserA->json();
        $idSC = $datos['idUsuario'];
        $message = 'Hola! Te informamos que el requerimiento con folio '.$data->folio.' se ha implementado. ~'.route("Archivo",Crypt::encrypt($data->folio)).'~. Gracias.';
        $notificacionController = new NotificacionController();
        $notificacionController->stnotify($idSC,$message);
        Mail::to($email)->cc($coordinacion->pluck('email'))->send(new Fase($data->folio, $data['id_estatus']));
      }
    }
    $val = liberacion::select('inicio_lib')->where('folio',$data['folio'])->get();
    foreach($val as $fecha){$this->validate($data, ['f_implementacion' => "required|date|after_or_equal:$fecha->inicio_lib"]);}
    $verificar = implementacion::where('folio',$data['folio'])->count();
    if($data['f_implementacion']<>NULL){$f_implementacion=date("y/m/d", strtotime($data['f_implementacion']));}else{$f_implementacion=NULL;}
    if($data['cronograma']==NULL){$data['cronograma']= 0;}
    if($verificar == 0){
      implementacion::create([
        'folio' => $data['folio'],
        'cronograma' => $data['cronograma'],
        'link_c' => $data['link_c'],
        'f_implementacion' => $f_implementacion,
        'estatus_f' => $data['estatus_f'],
        'seguimiento' => $data['seguimiento'],
        'comentarios' => $data['comentarios'],
      ]);
    }
    else{
      $update = implementacion::select('*')->where('folio',$data['folio'])->first();
      $update->cronograma = $data['cronograma'];
      $update->link_c = $data['link_c'];
      $update->f_implementacion = $f_implementacion;
      $update->estatus_f = $data['estatus_f'];
      $update->seguimiento = $data['seguimiento'];
      $update->comentarios = $data['comentarios'];
      $estatus->id_estatus = $data['id_estatus'];
      $estatus->save();
      $update->save(); 
    }
    $update = registro::select()-> where ('folio', $data->folio)->first();
    $update->id_estatus = $data->input('id_estatus');
    $update->save();
    return redirect(route('Documentos',Crypt::encrypt($data['folio'])));
    #dd($update);

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
