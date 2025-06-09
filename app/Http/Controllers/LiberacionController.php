<?php

namespace App\Http\Controllers;

use App\Mail\Cliente\Fase;
use App\Mail\Interno\Pruebas;
use App\Models\bitacora;
use App\Models\liberacion;
use App\Models\registro;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class LiberacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($folio){
        $registros = registro::where('registros.folio',Crypt::decrypt($folio))->first();
        return view('formatos.requerimientos.liberacion',compact('registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $data){
        $registro = registro::where('folio',$data['folio'])->first();
        //$estatus = $data['id_estatus'] ?? $registro->id_estatus;
        $this->validate($data, ['inicio_p_r' => "required|date|after_or_equal:{$registro->testing->fechaFinReal}"]);
        if($data['inicio_p_r']){$inicio_p_r=date("y/m/d H:i:s", strtotime($data['inicio_p_r']));}else{$inicio_p_r=NULL;}
        if($data['inicio_lib']){
            if($data['inicio_p_r']){
                $this->validate($data, ['inicio_lib' => "required|date|after_or_equal:$data[inicio_p_r]"]);
            }
            $inicio_lib=date("y/m/d H:i:s", strtotime($data['inicio_lib']));
        }else{$inicio_lib = NULL;}
        if($data['id_estatus'] == 2){
            $this->validate($data, ['inicio_lib' => "required|date|after_or_equal:$data[inicio_p_r]"]);
            // $this->Notificacion($registro);
            $requiredKeywords = ['matriz de pruebas', 'acta de validación'];
            $missingKeywords = [];
            foreach ($requiredKeywords as $requiredKeyword) {
                $keywordFound = false;
                foreach ($registro->archivos as $archivo) {
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
            $email = $registro->levantamiento->sol->email;
            $coordinacion = User:: select('email')
                ->leftjoin('usr_data as ud','ud.id_user','users.id')
                ->leftjoin('puestos as p','p.id_puesto','ud.id_puesto')
                ->leftjoin('accesos as a','ud.id_user','a.id_user')
                ->whereIn('jerarquia', [2, 3, 7])
                ->where('a.id_sistema',$registro->id_sistema)
                ->where('ud.id_area', 6)
                ->get();
            if($email){
                $notificacionUserA = Http::get('https://api-seguridad-67vdh6ftzq-uc.a.run.app/api/v1/login/validacionRF/0/' . $email);
                $datos = $notificacionUserA->json();
                $idSC = $datos['idUsuario'];
                $message = 'Hola! Te informamos que el requerimiento con folio '.$data->folio.' ha entrado a la fase de implementación. ~'.route("Archivo",Crypt::encrypt($data->folio)).'~. Gracias.';
                $notificacionController = new NotificacionController();
                $notificacionController->stnotify($idSC,$message);
            }
            Mail::to($email)->cc($coordinacion->pluck('email'))->send(new Fase($data->folio, '2'));// 
            $registro->id_estatus = $data['id_estatus'];
            $registro->save();
        }
        liberacion::updateOrCreate(
            ['folio' => $data['folio']],
            [
                'inicio_p_r' => $inicio_p_r,
                'inicio_lib' => $inicio_lib,
            ]);
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
    public function edit($folio){
        $registros = registro::where('registros.folio',Crypt::decrypt($folio))->first();
        return view('formatos.requerimientos.liberacion',compact('registros'));
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
        $registro = registro::where('folio',$data['folio'])->first();  
        if($data['inicio_p_r']){
            $this->validate($data, ['inicio_p_r' => "required|date|after_or_equal:{$registro->liberacion->fecha_lib_a}"]);
            $inicio_p_r=date("y/m/d H:i:s", strtotime($data['inicio_p_r']));
        }else{$inicio_p_r=NULL;}
        if($data['inicio_lib']){
            $this->validate($data, ['inicio_lib' => "required|date|after_or_equal:$data[inicio_p_r]"]);
            $inicio_lib=date("y/m/d H:i:s", strtotime($data['inicio_lib']));
        }else{$inicio_lib=NULL;}
        if($data['id_estatus'] == 2){
            $this->validate($data, ['inicio_lib' => "required|date|after_or_equal:$data[fecha_lib_a]"]);
            $this->validate($data, ['inicio_p_r' => "required|date|after_or_equal:$data[fecha_lib_a]"]);
        }
        $update = liberacion::select('*')->where('folio',$data['folio'])->first();
        $update->inicio_lib = $inicio_lib;
        $update->inicio_p_r = $inicio_p_r;
        $update->save();
        $registro->id_estatus = 8;
        $registro->save();
        if($data['estatus'] === 'Ronda'){
            return redirect(route('Ronda',Crypt::encrypt($data['folio'])));
        }
        else{
            return redirect(route('Documentos',Crypt::encrypt($data['folio'])));
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

    public function Notificacion($registro){
        $to             = $registro->rpip->email;
        $user           = User::findOrFAil(Auth::user()->id);
        $campo          = 
        bitacora::create([
          'folio'         => $registro->folio,
          'usuario'       => $user->getFullnameAttribute(),
          'id_user'       => $user->id,
          'campo'         => $registro->estatus->posicion = 9 ? "Fin pruebas Testing" : "Fin pruebas PIP",
          'id_estatus'    => $registro->id_estatus,
        ]);
        if($registro->estatus->posicion = 9){
            #$notificacionUserC = Http::get('https://api-seguridadv2.tiii.mx/api/v1/login/validacionRF/0/'.$to);
            $notificacionUserC = Http::get('https://api-seguridad-67vdh6ftzq-uc.a.run.app/api/v1/login/validacionRF/0/' . $to);
            $datos = $notificacionUserC->json();
            $idSC = $datos['idUsuario'];
            $message = $registro->estatus->posicion = 9 ?
            'Hola! Te informamos que el requerimiento con folio '.$registro->folio.'. ~'.route("Documentos",Crypt::encrypt($registro->folio)).'~. ha terminado de ser probado por testing. Gracias.' :
            'Hola! Te informamos que el requerimiento con folio '.$registro->folio.'. ~'.route("Documentos",Crypt::encrypt($registro->folio)).'~. ha terminado de ser probado por PIP. Gracias.';
            $notificacionController = new NotificacionController();
            $notificacionController->stnotify($idSC,$message);
    
            // Los archivos requeridos existen, proceder con el envío de correo y actualización de estatus
            Mail::to($registro->rpip->email)->cc($registro->rdes->email)->send(new Pruebas($registro->folio));
        }
      }
}
