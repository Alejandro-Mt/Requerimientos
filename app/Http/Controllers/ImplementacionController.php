<?php

namespace App\Http\Controllers;

use App\Mail\Cliente\Fase;
use App\Models\archivo;
use App\Models\implementacion;
use App\Models\levantamiento;
use App\Models\liberacion;
use App\Models\registro;
use App\Models\User;
use App\Models\usr_data;
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
   */public function create(Request $data) {
    // Obtiene el registro por folio
    $estatus = registro::where('folio', $data->folio)->first();
    $data['id_estatus'] = $data['id_estatus'] ?? 2;

    // Si el estatus es distinto de NULL, verifica los archivos adjuntos
    if ($data['id_estatus'] != 2) {
      $archivos = Archivo::where('folio', $data['folio'])->get();
      $requiredKeyword = 'acta de cierre';
      $keywordFound = $archivos->contains(function($archivo) use ($requiredKeyword) {
        return str_contains(mb_strtolower($archivo->url), $requiredKeyword);
      });

      if (!$keywordFound) {
        Session::flash('error', "No se ha adjuntado el archivo: " . strtoupper($requiredKeyword));
        return redirect()->back();
      }

      $email = $estatus->levantamiento->sol->email;
      if ($email) {
        try {
          $notificacionUserA = Http::get('https://api-seguridad-67vdh6ftzq-uc.a.run.app/api/v1/login/validacionRF/0/' . $email);
          $datos = $notificacionUserA->json();
          $idSC = $datos['idUsuario'];
          $message = 'Hola! Te informamos que el requerimiento con folio ' . $data->folio . ' se ha implementado. ~' . route("Archivo", Crypt::encrypt($data->folio)) . '~. Gracias.';
          $notificacionController = new NotificacionController();
          $notificacionController->stnotify($idSC, $message);
          
          $coordinacionEmails = usr_data::select('email')
              ->leftJoin('users as u', 'u.id', 'usr_data.id_user')
              ->leftJoin('puestos as p', 'p.id_puesto', 'usr_data.id_puesto')
              ->leftJoin('accesos as a', 'usr_data.id_user', 'a.id_user')
              ->whereIn('jerarquia', [2, 3, 7])
              ->where('a.id_sistema', $data['id_sistema'])
              ->where(function ($query) {
                  $query->where('usr_data.id_area', '!=', '12')->orWhere('jerarquia', '7');
            })
            ->pluck('email');
          
          Mail::to($email)->cc($coordinacionEmails)->send(new Fase($data->folio, $data['id_estatus']));
        } catch (\Exception $e) {
          // Manejo de errores si la API o el envío de correo falla
          Session::flash('error', 'Error en el envío de notificaciones: ' . $e->getMessage());
          return redirect()->back();
        }
      }
    }

    // Validación de fecha de implementación
    $fechaInicioLib = liberacion::where('folio', $data['folio'])->value('inicio_lib');
    if ($fechaInicioLib) {
      $this->validate($data, ['f_implementacion' => "required|date|after_or_equal:$fechaInicioLib"]);
    }

    // Preparar datos de implementación
    $f_implementacion = $data['f_implementacion'] ? date("y/m/d", strtotime($data['f_implementacion'])) : NULL;
    $data['cronograma'] = $data['cronograma'] ?? 0;

    // Inserta o actualiza implementación
    $implementacion = implementacion::updateOrCreate(
      ['folio' => $data['folio']],
      [
        'cronograma' => $data['cronograma'],
        'link_c' => $data['link_c'],
        'f_implementacion' => $f_implementacion,
        'estatus_f' => $data['estatus_f'],
        'seguimiento' => $data['seguimiento'],
        'comentarios' => $data['comentarios'],
      ]
    );
    // Actualizar el estatus del registro
    $estatus->id_estatus = $data['id_estatus'];
    $estatus->save();

    return redirect(route('Documentos', Crypt::encrypt($data['folio'])));
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
