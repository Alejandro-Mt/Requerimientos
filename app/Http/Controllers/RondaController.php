<?php

namespace App\Http\Controllers;

use App\Mail\Cliente\Fase;
use App\Models\archivo;
use App\Models\desfase;
use App\Models\levantamiento;
use App\Models\planeacion;
use App\Models\liberacion;
use App\Models\registro;
use App\Models\ronda;
use App\Models\solicitud;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class RondaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($folio)
    {
        $id = registro::select('folio')->where('folio',Crypt::decrypt($folio))->first();
        $registros = registro::select('registros.folio', 'registros.id_estatus','p.evidencia as def','l.fecha_def')
          ->leftjoin('levantamientos as l','registros.folio','l.folio')
          ->leftjoin('planeacion as p','registros.folio','p.folio')
          ->where('registros.folio',Crypt::decrypt($folio))->first();
        $ronda = ronda::where('folio',Crypt::decrypt($folio))->count();
        $solinf = liberacion::where('folio',Crypt::decrypt($folio))->whereNotNull('inicio_lib')->count();
        /*if($solinf === 0){
            $solinf = 1;
        }*/
        $vacio = planeacion:: select('*')->where('folio',Crypt::decrypt($folio))->count();
        return view('formatos.requerimientos.seguimiento.pruebas.rondas',compact('id','registros','ronda','solinf','vacio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        $registro = registro::select()->where('folio', $data['folio'])->first();
        if ($data['rechazadas'] == 0){
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
            $registro->id_estatus = 2;
            $registro->liberacion->evidencia_p=true;
            $registro->liberacion->save();
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
                $notificacionUserA = Http::get('https://api-seguridadv2.tiii.mx/api/v1/login/validacionRF/0/'.$email);
                $datos = $notificacionUserA->json();
                $idSC = $datos['idUsuario'];
                $message = 'Hola! Te informamos que el requerimiento con folio '.$data->folio.' ha entrado a la fase de implementación. ~'.route("Archivo",Crypt::encrypt($data->folio)).'~. Gracias.';
                $notificacionController = new NotificacionController();
                $notificacionController->stnotify($idSC,$message);
                Mail::to($email)->cc($coordinacion->pluck('email'))->send(new Fase($data->folio, '2'));
            }
        }else{
            $registro->id_estatus = 8;
        }
        ronda::create([
            'folio' => $data['folio'],
            'ronda' => $data['ronda'],
            'aprobadas' => $data['aprobadas'],
            'rechazadas' => $data['rechazadas'],
            'evidencia' => $data['evidencia'],
            'efectividad' => ($data['aprobadas']/($data['aprobadas']+$data['rechazadas']))*100,
        ]);
        $registro->save();
        
        $liberacionController = new LiberacionController();
        $liberacionController->Notificacion($registro);
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
    public function edit(Request $data)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data, $id_puesto)
    {
        $update = ronda::FindOrFail($id_puesto);
        $update->puesto = $data['puesto'];
        $update->jerarquia = $data['jerarquia'];
        $update->save();  
        return redirect(route('Seguir'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_puesto)
    {
        $puesto = ronda::find($id_puesto);
        $puesto->delete();
        return redirect(route('Seguir'));
    }
}
