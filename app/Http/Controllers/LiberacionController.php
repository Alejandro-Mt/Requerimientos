<?php

namespace App\Http\Controllers;

use App\Mail\interno\Pruebas;
use App\Models\bitacora;
use App\Models\liberacion;
use App\Models\registro;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class LiberacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($folio){
        $registros = registro::where('registros.folio',Crypt::decrypt($folio))->first();
        return view('formatos.requerimientos.pruebasT',compact('registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $data){
        $registro = registro::where('folio',$data['folio'])->first();  
        $this->validate($data, ['fecha_lib_a' => "required|date|after_or_equal:{$registro->construccion->fechaCompReqR}"]);
        if($data['fecha_lib_a']<>NULL){$fecha_lib_a=date("y/m/d H:i:s", strtotime($data['fecha_lib_a']));}else{$fecha_lib_a=NULL;}
        if($data['fecha_lib_r']<>NULL){
            if($data['fecha_lib_a'] <> NULL){
                $this->validate($data, ['fecha_lib_r' => "required|date|after_or_equal:$data[fecha_lib_a]"]);
            }
            $fecha_lib_r=date("y/m/d H:i:s", strtotime($data['fecha_lib_r']));
        }else{$fecha_lib_r=NULL;}
        if($data['id_estatus'] == 8){
            $this->validate($data, ['fecha_lib_r' => "required|date|after_or_equal:$data[fecha_lib_a]"]);
            $this->Notificacion($registro);
        }
        liberacion::updateOrCreate(
            ['folio' => $data['folio']],
            [
                'fecha_lib_a' => $fecha_lib_a,
                'fecha_lib_r' => $fecha_lib_r,
            ]);
        $registro->id_estatus = $data['id_estatus'] ?? 23;
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
            $notificacionUserC = Http::get('https://api-seguridadv2.tiii.mx/api/v1/login/validacionRF/0/'.$to);
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
