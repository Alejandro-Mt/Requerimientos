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
        $registros = registro::select('folio', 'id_estatus')->where('folio',Crypt::decrypt($folio))->first();
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
        $liberacion = liberacion::where('folio', $data['folio'])->first();
        $estatus = registro::select()->where('folio', $data['folio'])->first();
        $archivos = Archivo::where('folio', $data['folio'])->get();
        if ($data['rechazadas'] == 0){
            $requiredKeywords = ['matriz de pruebas', 'acta de validación'];
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
            $estatus->id_estatus = 2;
            $liberacion->evidencia_p=true;
            $liberacion->save();
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
            if($email){Mail::to($email->email)->cc($gerencia->pluck('email'))->send(new Fase($data->folio, '2'));}
        }else{
            $estatus->id_estatus = 8;
        }
        ronda::create([
            'folio' => $data['folio'],
            'ronda' => $data['ronda'],
            'aprobadas' => $data['aprobadas'],
            'rechazadas' => $data['rechazadas'],
            'evidencia' => $data['evidencia'],
            'efectividad' => ($data['aprobadas']/($data['aprobadas']+$data['rechazadas']))*100,
        ]);
        $estatus->save();
        return redirect(route('Documentos',Crypt::encrypt($data['folio'])));
        #dd($data);
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
        #dd($data);
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
        #dd($id_estatus);
    }
}
