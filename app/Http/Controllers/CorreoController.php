<?php

namespace App\Http\Controllers;

use App\Mail\Cliente\DefinicionRequerimiento;
use App\Mail\Interno\N_Flujo;
use App\Mail\SegundaValidacion;
use App\Mail\ValidacionCliente;
use App\Mail\ValidacionRequerimiento;
use App\Models\archivo;
use App\Models\bitacora;
use App\Models\clase;
use App\Models\levantamiento;
use App\Models\liberacion;
use App\Models\registro;
use App\Models\sistema;
use App\Models\User;
use App\Models\usr_data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;

class CorreoController extends Controller
{
    //
    
  public function send($folio){
    $registro = Registro::where('folio', Crypt::decrypt($folio))->first();
    return view('layouts.correo',compact('registro'));
  }

  public function sended(Request $data){
    $folio = Crypt::decrypt($data['folio']);
    $datos = Registro::where('folio', $folio)->first();
    if($datos->estatus->posicion = 4){
      // Verificar si los archivos requeridos existen
      $requiredKeywords = ['gantt'];
      $missingKeywords = [];
      foreach ($requiredKeywords as $requiredKeyword) {
        $keywordFound = false;
        foreach ($datos->archivos as $archivo) {
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
      $this->NotITEAM($datos, $data);
    }
    $successMessage = "El correo ha sido enviado.";
    return redirect(route('Documentos', $data->folio))->with('success', $successMessage);
  }

  protected function PDF($folio){
    $pdf = new Mpdf();
    $folio = Crypt::decrypt($folio);
    $formato = registro::where('folio',$folio)->first();
    $sistemas = sistema::all();
    $responsables = User::all();
    $relaciones = explode(',',$formato->levantamiento->relaciones);
    $involucrados = explode(',',$formato->levantamiento->involucrados);
    $html = view('correos.Plantilla',compact('formato','involucrados','relaciones','responsables','sistemas'));
    $pdf->WriteHTML($html);
    $nombreArchivo = $folio.' '.$formato->descripcion.'.pdf';

    // Genera una respuesta HTTP con el PDF y descárgalo
    $pdf->Output($nombreArchivo, \Mpdf\Output\Destination::INLINE);
  }

  protected function respuesta($folio){
    $levantamiento = levantamiento::findOrFail($folio);
    $involucrados = User::whereIn('id',explode(',', $levantamiento->involucrados))->get();
    $ct = usr_data::where('id_puesto', 7)->first();
    $fol = registro::where('folio',$folio)->first();
    #$notificacionUserC = Http::get('https://api-seguridadv2.tiii.mx/api/v1/login/validacionRF/0/'.$fol->rpip->email);
    $notificacionUserC = Http::get('https://api-seguridad-67vdh6ftzq-uc.a.run.app/api/v1/login/validacionRF/0/' . $fol->rpip->email);
    $datos = $notificacionUserC->json();
    $idSC = $datos['idUsuario'];
    if(is_null($levantamiento->fechaaut)){ 
      $levantamiento -> fechaaut = now();
      $levantamiento -> save();
      $message = 'Hola! Te informamos que el levantamiento del requerimiento con folio '.$folio. ' ha sido autorizado. ~'.route("Documentos",Crypt::encrypt($folio)).'~.  Gracias.';
      $notificacionController = new NotificacionController();
      $notificacionController->stnotify($idSC,$message);
      Mail::to($fol->rpip->email)->cc($involucrados->pluck('email'))->send(new ValidacionRequerimiento($folio));
      #session()->flash('autorizado', 'Se ha autorizado satisfactoriamente');
      return redirect(route('Documentos',Crypt::encrypt($folio)))->withCookie(cookie('autorizado', 'Se ha autorizado satisfactoriamente', 1));
    }else{
      if($fol->id_estatus == 9 && is_null($levantamiento->fecha_def)){
        $levantamiento -> fecha_def = now();
        $levantamiento -> save();
        $ccEmails = $involucrados->pluck('email')->toArray();
        if ($fol->id_tester) {
          $ccEmails[] = $fol->rtest->email;
        }
        $message = 'Hola! Te informamos que la definición del requerimiento con folio '.$folio. ' ha sido autorizada. ~'.route("Documentos",Crypt::encrypt($folio)).'~.  Gracias.';
        $notificacionController = new NotificacionController();
        $notificacionController->stnotify($idSC,$message);
        Mail::to($fol->rpip->email)->cc($ccEmails)->send(new ValidacionRequerimiento($folio));
        #Mail::to($ct->email)->send(new ValidacionRequerimiento($folio));
        #session()->flash('autorizado', 'Se ha autorizado satisfactoriamente');
        return redirect(route('Documentos',Crypt::encrypt($folio)))->withCookie(cookie('autorizado', 'Se ha autorizado satisfactoriamente', 1));
      }else{
        #session()->flash('autorizado', 'Ya ha sido autorizado');
        return redirect(route('Documentos',Crypt::encrypt($folio)))->withCookie(cookie('autorizado', 'Ya ha sido autorizado', 1));
      }
    }
  }

  public function rechazo($folio){
    $fol = registro::where('folio',$folio)->first();
    $coordinacion = User:: select('email')
      ->leftjoin('usr_data as ud', 'id','id_user')
      ->leftjoin('puestos as p','p.id_puesto','ud.id_puesto')
      ->leftjoin('accesos as a','ud.id_user','a.id_user')
      ->whereIn('jerarquia', [2, 3, 7])
      ->where('a.id_sistema',$fol->id_sistema)
      ->get();
    $hora = levantamiento::findOrFail($folio);
    #$notificacionUserA = Http::get('https://api-seguridadv2.tiii.mx/api/v1/login/validacionRF/0/'.$fol->rpip->email);
    $notificacionUserA = Http::get('https://api-seguridad-67vdh6ftzq-uc.a.run.app/api/v1/login/validacionRF/0/' . $fol->rpip->email);
    $datos = $notificacionUserA->json();
    $idSC = $datos['idUsuario'];
    if($hora->fechaaut == NULL){ 
      $message = 'Hola! Te informamos que el documento de levantamiento del requerimiento con folio '.$folio.'. ~'.route("Archivo",Crypt::encrypt($folio)).'~, ha sido rechazado. Gracias.';
      #dd($idSC,$message);
      $notificacionController = new NotificacionController();
      $notificacionController->stnotify($idSC,$message);
      Mail::to($fol->rpip->email)->cc($coordinacion->pluck('email'))->send(new ValidacionRequerimiento($folio));
      return redirect(route('Documentos',Crypt::encrypt($folio)))->withCookie(cookie('rechazo', 'Se ha enviado la respuesta, gracias.', 1));
      #dd($correo->dispercion);  
    }else{
        if($hora->fecha_def == NULL){
        $ccEmails = $coordinacion->pluck('email')->toArray();
        if ($fol->id_tester) {
          $ccEmails[] = $fol->rtest->email;
        }
        $message = 'Hola! Te informamos que el documento de definición del requerimiento con folio '.$folio.'. ~'.route("Archivo",Crypt::encrypt($folio)).'~, ha sido rechazado. Gracias.';
        $notificacionController = new NotificacionController();
        $notificacionController->stnotify($idSC,$message);
        Mail::to($fol->rpip->email)->cc($ccEmails)->send(new ValidacionRequerimiento($folio));
        return redirect(route('Documentos',Crypt::encrypt($folio)))->withCookie(cookie('rechazo', 'Se ha enviado la respuesta, gracias.', 1));   
      }else{
        return redirect(route('Documentos',Crypt::encrypt($folio)))->withCookie(cookie('rechazo', 'El folio ya ha sido autorizado, en caso de querer cancelarlo por favor contacte a soporte.', 1));
        #return ('El folio ya ha sido autorizado, en caso de querer cancelarlo por favor contacte a soporte');
      }
    }
  }

  protected function NotITEAM($form,$data){
    $involucrados   = levantamiento::where('folio', $form->folio)->first();
    $user           = User::findOrFAil(Auth::user()->id);
    $campo          = 
    bitacora::create([
      'folio'         => $form->folio,
      'usuario'       => $user->getFullnameAttribute(),
      'id_user'       => $user->id,
      'campo'         => $form->estatus->posicion = 5 ? "Se envió formato de solicitud a cliente" : "Se envió formato de solicitud a desarrollo",
      'id_estatus'    => $form->id_estatus,
    ]);
    #$notificacionUserC = Http::get('https://api-seguridadv2.tiii.mx/api/v1/login/validacionRF/0/'.$data->email[0]);
    $notificacionUserC = Http::get('https://api-seguridad-67vdh6ftzq-uc.a.run.app/api/v1/login/validacionRF/0/' . $data->email[0]);
    $datos = $notificacionUserC->json();
    $idSC = $datos['idUsuario'];
    $message = $form->estatus->posicion = 5 ?
    'Hola! Te compartimos el documento de levantamiento del requerimiento con folio '.$form->folio.'. ~'.route("Archivo",Crypt::encrypt($form->folio)).'~. También se ha enviado a su correo la documentación para su clasificación. Gracias.' :
    'Hola! Te compartimos el documento de levantamiento de tu requerimiento con folio '.$form->folio.'. ~'.route("Archivo",Crypt::encrypt($form->folio)).'~. También se ha enviado a su correo la documentación para su autorización. Gracias.';
    $notificacionController = new NotificacionController();
    $notificacionController->stnotify($idSC,$message);

    // Los archivos requeridos existen, proceder con el envío de correo y actualización de estatus
    $cc = $involucrados->involucrados($form->folio)->pluck('email');
    Mail::to($data->email)->cc($cc)->send(new ValidacionCliente($form->folio));
    if (count(Mail::failures()) < 1) {
      $form->id_estatus = $data['id_estatus'];
      $form->save();
    } else {
      $errorMessage = "No se pudo enviar el correo. Vuelve a intentarlo.";
      return redirect(route('Documentos', $data->folio))->with('error', $errorMessage);
    }
  }

  protected function clase(Request $data, $folio){
    $clase = registro::where('folio',$folio)->first();
    $impacto = clase::findOrFail($data['id_clase']);
    $hora = levantamiento::findOrFail($folio);
    $correo = registro::where('folio',$folio)->first();
    $involucrados = $correo->levantamiento->involucrados($folio);
    if($hora->fechades == NULL){ 
      $hora -> fechades = now();
      $hora -> impacto = $impacto->id_impacto;
      $hora -> save();
      $clase -> id_clase = $data['id_clase'];
      $clase -> save();
      Mail::to($correo->rpip->email)->cc($involucrados->pluck('email'))->send(new SegundaValidacion($folio));
      #$notificacionUserC = Http::get('https://api-seguridadv2.tiii.mx/api/v1/login/validacionRF/0/'.$correo->rpip->email);
      $notificacionUserC = Http::get('https://api-seguridad-67vdh6ftzq-uc.a.run.app/api/v1/login/validacionRF/0/' . $correo->rpip->email);
      $datos = $notificacionUserC->json();
      $idSC = $datos['idUsuario'];
      $message = 'Hola! Te informamos que desarrollo ha designado la clase del requerimiento con folio '.$folio. '. ~'.route("Documentos",Crypt::encrypt($folio)).'~.  Gracias.';
      $notificacionController = new NotificacionController();
      $notificacionController->stnotify($idSC,$message);
      return redirect(route('Documentos',Crypt::encrypt($folio)))->with('autorizado', 'Se ha autorizado satisfactoriamente'); 
    }else{
      return redirect(route('Documentos',Crypt::encrypt($folio)))->with('rechazo', 'El folio ya ha sido autorizado, en caso de querer cancelarlo por favor contacte a soporte');
      #dd($hora);
    }
  }
  
  public function segval ($folio){
    $registro       = registro::where('folio',$folio)->first();
    $levantamiento  = levantamiento::FindOrFail($folio);
    $user           = User::findOrFAil(Auth::user()->id);
    switch($registro->id_estatus){
      case 1:
        $validar = Archivo::where('folio', $folio)
          ->where(function ($query) {$query->where('url', 'like', '%flujo%')->orWhere('url', 'like', '%prototipo%');})
          ->first();
        $campo      = bitacora::create([
          'folio'         => $folio,
          'usuario'       => $user->getFullnameAttribute(),
          'id_user'       => $user->id,
          'campo'         => "Se envió nuevo flujo a desarrollo",
          'id_estatus'    => $registro->id_estatus,
        ]);
        if ($registro->rdes && $validar) {
          $notificacionUserA = Http::get('https://api-seguridad-67vdh6ftzq-uc.a.run.app/api/v1/login/validacionRF/0/' . $registro->rdes->email);
          if($notificacionUserA){
            $datos = $notificacionUserA->json();
            $idSC = $datos['idUsuario'];
            $message = 'Hola! Te informamos que PIP ha agregado el nuevo flujo para el requerimiento con folio '.$registro->folio.' se ha enviado a tu correo para su validación. ~'.route("Archivo",Crypt::encrypt($registro->folio)).'~. Gracias.';
            $notificacionController = new NotificacionController();
            $notificacionController->stnotify($idSC,$message);
          }
          Mail::to($registro->rdes->email)->send(new N_Flujo($registro->folio));
          return redirect(route('Documentos',Crypt::encrypt($folio)));
        }
        return redirect(route('Documentos',Crypt::encrypt($folio)))->with('fail', 'Se necesita archivo para avanzar');
        break;
      case 9: 
          $levantamiento->fecha_def = now(); 
          $levantamiento->save();
        break;
      case 7:
          $levantamiento->fechades = now(); 
          $levantamiento->save();
        break;
      case 2:
          $update = liberacion::FindOrFail($folio);
          $update->evidencia_p = true; 
          $update->save();
      break;
    }
    return redirect(route('Documentos',Crypt::encrypt($folio)));
    #return ($update);
  }
  function validateAndRenameFile($fileName, $folio, $registro)
  {
      $validFileNames = [
          'matriz de pruebas',
          'acta de validación',
          'acta de cierre',
          'definición de requerimiento',
          'mockup',
          'flujo',
          'prototipo',
          'plan de trabajo'
      ];

      $rename = mb_strtolower($fileName);

      $matriz = archivo::where([
        ['folio', $folio],
        ['url', 'like', '%matriz de pruebas%']
      ])->first();
      
      foreach ($validFileNames as $validName) {
        if (stristr($rename, $validName)) {
          return $rename; // Encontró una coincidencia válida
        }
      }

      // Asignación de nombres según la posición del estatus
      if ($registro->estatus->posicion == 4 || $registro->estatus->posicion == 5) {
        return $folio . ' Gantt';
      } elseif (($registro->estatus->posicion == 6) || ($registro->estatus->posicion == 8 && !$registro->levantamiento->fecha_def)) {
        return $folio . ' Definición de requerimiento';
      } elseif ($registro->estatus->posicion == 7) {
        return $folio . ' Flujo';
      } elseif ($registro->estatus->posicion == 8 && $registro->levantamiento->fecha_def) {
        return $folio . ' Plan de trabajo';
      } elseif ($registro->estatus->posicion == 11) {
        return $matriz ? $folio . ' Acta de validación' : $folio . ' Matriz de pruebas';
      } elseif ($registro->estatus->posicion == 12) {
        return $folio . ' Acta de cierre';
      }
      return null;
  }


  /*function store(Request $data, $folio)
  {

      $registro = registro::where('folio', $folio)->first();
      $definicion = archivo::where([
          ['folio', $folio],
          ['url', 'like', '%Definición de requerimiento%'],
          ['url', 'not like', '%versión%']
        ])->first();
      $version = archivo::where([
          ['folio', $folio],
          ['url', 'like', '%Definición de requerimiento%']])->count();
      $plan = archivo::where([
          ['folio', $folio],
          ['url', 'like', '%Flujo de trabajo%']
        ])->first();
      $matriz = archivo::where([
          ['folio', $folio],
          ['url', 'like', '%matriz de pruebas%']
        ])->first();

      if ($data->hasFile('adjunto')) {
        $file = $data->file('adjunto');
        $rename = validateAndRenameFile($file->getClientOriginalName(), $folio, $registro, $matriz, $version, $definicion);
        #$rename = mb_strtolower($data->file('adjunto')->getClientOriginalName());
          foreach ($validFileNames as $validName) {
              if (stristr($rename, $validName)) {
                  break; // Salir del bucle al encontrar una coincidencia
              } else {
                  $rename = null;
              }
          }
          if (empty($rename)) {
            if ($registro->estatus->posicion == 4 || $registro->estatus->posicion == 5) {
              $rename = $folio . ' Gantt';
            }elseif (($registro->estatus->posicion == 6) || ($registro->estatus->posicion == 8 && !$registro->levantamiento->fecha_def)) {
              $rename = $folio . ' Definición de requerimiento';
            } elseif ($registro->estatus->posicion == 7) {
              $rename = $folio . ' Flujo';
            } elseif ($registro->estatus->posicion == 8 && $registro->levantamiento->fecha_def) {
                $rename = $folio . ' Plan de trabajo';
            } elseif ($registro->estatus->posicion == 11) {
                $rename = $matriz ? $folio . ' Acta de validación' : $folio . ' Matriz de pruebas';
            } elseif ($registro->estatus->posicion == 12) {
                $rename = $folio . ' Acta de cierre';
            } 
          }
          if ($version > 0 && $rename == $folio . ' Definición de requerimiento') {
              $originalName = pathinfo($definicion->url, PATHINFO_FILENAME);
              $orginalPath = "public/$folio/" . $originalName . '.' . $data->file('adjunto')->getClientOriginalExtension();
              $newFileName = $folio . ' Definición de requerimiento' . " versión " . $version;
              $newFilePath = "public/$folio/extra/$newFileName." . $data->file('adjunto')->getClientOriginalExtension();
              Storage::move($orginalPath, $newFilePath);
              $definicion->update(['url' => "/storage/$folio/extra/$newFileName." . $data->file('adjunto')->getClientOriginalExtension()]);
          }

          $files = Storage::putFileAs("public/$folio", $data->file('adjunto'), "$rename." . $data->file('adjunto')->getClientOriginalExtension());
          archivo::create(['folio' => $folio, 'url' => "/storage/$folio/$rename.". $data->file('adjunto')->getClientOriginalExtension()]);
      } elseif($data->hasFile('Complemento')) {
          $rename = $data->file('Complemento')->getClientOriginalName();
          $files = Storage::putFileAs("public/$folio/COMPLEMENTOS", $data->file('Complemento'), $rename);
          archivo::create(['folio' => $folio, 'url' => "/storage/$folio/COMPLEMENTOS/$rename"]);
      } else{
          $rename = $data->file('General')->getClientOriginalName();
          $files = Storage::putFileAs("public/$folio", $data->file('General'), $rename);
          archivo::create(['folio' => $folio, 'url' => "/storage/$folio/$rename"]);
      }
  }*/

  function store(Request $data, $folio)
  {
    $registro = registro::where('folio', $folio)->first();
    $definicion = archivo::where([
      ['folio', $folio],
      ['url', 'like', '%Definición de requerimiento%'],
      ['url', 'not like', '%versión%']
    ])->first();
    $version = archivo::where([
      ['folio', $folio],
      ['url', 'like', '%Definición de requerimiento%']
    ])->count();

    if ($data->hasFile('adjunto')) {
      $file = $data->file('adjunto');
      $rename = $this->validateAndRenameFile($file->getClientOriginalName(), $folio, $registro);

      if ($rename && $version > 0 && $rename == $folio . ' Definición de requerimiento') {
        $originalName = pathinfo($definicion->url, PATHINFO_FILENAME);
        $originalPath = "public/$folio/" . $originalName . '.' . $file->getClientOriginalExtension();
        $newFileName = $folio . ' Definición de requerimiento versión ' . $version;
        $newFilePath = "public/$folio/extra/$newFileName." . $file->getClientOriginalExtension();
        Storage::move($originalPath, $newFilePath);
        $definicion->update(['url' => "/storage/$folio/extra/$newFileName." . $file->getClientOriginalExtension()]);
      }

      $files = Storage::putFileAs("public/$folio", $file, "$rename." . $file->getClientOriginalExtension());
      $file = archivo::create(['folio' => $folio, 'url' => "/storage/$folio/$rename." . $file->getClientOriginalExtension()]);
      return response()->json(['id' => $file->id], 201);

    } elseif ($data->hasFile('Complemento')) {
      $rename = $data->file('Complemento')->getClientOriginalName();
      $files = Storage::putFileAs("public/$folio/COMPLEMENTOS", $data->file('Complemento'), $rename);
      $file = archivo::create(['folio' => $folio, 'url' => "/storage/$folio/COMPLEMENTOS/$rename"]);
      return response()->json(['id' => $file->id], 201);

    } else {
      $rename = $data->file('General')->getClientOriginalName();
      $files = Storage::putFileAs("public/$folio", $data->file('General'), $rename);
      $file = archivo::create(['folio' => $folio, 'url' => "/storage/$folio/$rename"]);
      return response()->json(['id' => $file->id], 201);
    }
  }

  public function destroy($id){
    #$name = pathinfo($data->file, PATHINFO_FILENAME);
    $archivo = archivo::findorfail($id);
    $file = str_replace('storage',"public",$archivo->url);
    Storage::delete($file);
    $archivo->delete();
  }
}
