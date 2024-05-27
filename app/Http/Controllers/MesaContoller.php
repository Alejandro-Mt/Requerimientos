<?php

namespace App\Http\Controllers;

use App\Mail\General\Mesa as GeneralMesa;
use App\Models\mesa;
use App\Models\registro;
use App\Models\solicitud;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MesaContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($folio)
    {
        //
        $responsables = User::all();
        $data = registro::where('folio',Crypt::decrypt($folio))->first();
        return view('formatos.requerimientos.seguimiento.mesa',compact('data','responsables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data, $folio)
    {
        if (Auth::check()) {
            $folio          = Crypt::decrypt($folio);
            $fecha_mesa     = Carbon::parse($data['fecha_mesa']);
            $participantes  = json_encode($data['participantes']);
            if ($data->hasFile('minuta')) {
                #$rename = mb_strtolower($data->file('minuta')->getClientOriginalName());
                if ($data['es_alcance']) {
                    $rename = 'Evidencia de mesa de alcance';
                }
                else{
                    $rename = 'Evidencia de mesa de trabajo';
                }
                $version = mesa::where([
                    ['folio', $folio],
                    ['evidencia', 'like', '%'.$rename.'%']
                ])->count();
                if ($version > 0) {
                    $FileName = $folio . ' ' . $rename . ' ' . $version;
                }else{
                    $FileName = $folio . ' ' . $rename;
                }
                Storage::putFileAs("public/$folio/COMPLEMENTOS", $data->file('minuta'), "$FileName." . $data->file('minuta')->getClientOriginalExtension());
                $mesa = mesa::create([
                    'fecha_mesa' => $fecha_mesa,
                    'folio'      => $folio, 
                    'es_alcance' => $data['es_alcance'],
                    'evidencia' => "/storage/$folio/COMPLEMENTOS/$FileName.". $data->file('minuta')->getClientOriginalExtension(),
                    'participantes' => $participantes,
                    'objetivo' => $data['objetivo']
                ]);
            }
            $this->Notification($mesa, $data);
            return redirect()->route('Documentos',Crypt::encrypt($folio));
        } else {
            // Si la sesión ha expirado, redirigir al usuario al inicio de sesión
            return redirect()->route('login')->with('message', 'Su sesión ha expirado. Por favor, inicie sesión nuevamente.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Notification($mesa, $data)
    {
        $to  = solicitud::where('folior', $mesa->folio)->first();
        $cc  = User::whereIn('id', $data['participantes'])->get();
        if ($mesa) {
            $notificacionUserU = Http::get('https://api-seguridadv2.tiii.mx/api/v1/login/validacionRF/0/'.$to->correo);
            $datos = $notificacionUserU->json();
            $idSC = $datos['idUsuario'];
            $message = 'Hola! Te informamos que se ha agregado la evidencia de la mesa de trabajo realizada del folio '.$mesa->folio.' Puedes visualizarla en ~'.route("Documentos",Crypt::encrypt($mesa->folio)).'~. Gracias.';
            $notificacionController = new NotificacionController();
            $notificacionController->stnotify($idSC,$message);
        }
        if($cc){
            foreach ($cc as $ecc) {
                $notificacionP = Http::get('https://api-seguridadv2.tiii.mx/api/v1/login/validacionRF/0/' .  $ecc->email);
                $resultado = $notificacionP->json();
                if($resultado['idUsuario']){
                    $idSC = $resultado['idUsuario'];
                    $message = 'Hola! Te informamos que se ha agregado la evidencia de la mesa de trabajo realizada del folio '.$mesa->folio.' Puedes visualizarla en ~'.route("Documentos",Crypt::encrypt($mesa->folio)).'~. Gracias.';
                    $notificacionController = new NotificacionController();
                    $notificacionController->stnotify($idSC,$message);
                }
            }
        }
        Mail::to($to->correo)->cc($cc->pluck('email'))->send(new GeneralMesa($mesa));
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
