<?php

namespace App\Http\Controllers;

use App\Models\mesa;
use App\Models\registro;
use App\Models\responsable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
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
        $responsables = responsable::all();
        $data = registro::where('folio',Crypt::decrypt($folio))->first();
        return view('formatos\requerimientos\seguimiento\mesa',compact('data','responsables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data, $folio)
    {
        if (Auth::check()) {
        // Continuar con el procesamiento del formulario
            $folio = Crypt::decrypt($folio);
            $fecha_mesa = Carbon::parse($data['fecha_mesa']);
            $participantes = json_encode($data['participantes']);
            if ($data->hasFile('minuta')) {
                $rename = mb_strtolower($data->file('minuta')->getClientOriginalName());
                if ($rename != 'Evidencia de mesa') {
                    $rename = 'Evidencia de mesa de alcance';
                }
                $evidencia = mesa::where([
                    ['folio', $folio],
                    ['evidencia', 'like', '%'.$rename.'%'],
                    ['evidencia', 'not like', '%versión%']
                ])->first();
                $version = mesa::where([
                    ['folio', $folio],
                    ['evidencia', 'like', '%'.$rename.'%']
                ])->count();
                if ($version > 0 && $rename == $folio . ' Evidencia de mesa de alcance') {
                    $originalName = pathinfo($evidencia->evidencia, PATHINFO_FILENAME);
                    $orginalPath = "public/$folio/COMPLEMENTOS/" . $originalName . '.' . $data->file('minuta')->getClientOriginalExtension();
                    $newFileName = $folio . ' Evidencia de mesa de alcance ' . $version;
                    $newFilePath = "public/$folio/extra/$newFileName." . $data->file('minuta')->getClientOriginalExtension();
                    Storage::move($orginalPath, $newFilePath);
                    $evidencia->update(['url' => "/storage/$folio/extra/$newFileName." . $data->file('minuta')->getClientOriginalExtension()]);
                }
                $files = Storage::putFileAs("public/$folio/COMPLEMENTOS", $data->file('minuta'), "$rename." . $data->file('minuta')->getClientOriginalExtension());
                mesa::create([
                    'fecha_mesa' => $fecha_mesa,
                    'folio'      => $folio, 
                    'es_alcance' => $data['es_alcance'],
                    'evidencia' => "/storage/$folio/COMPLEMENTOS/$rename.". $data->file('minuta')->getClientOriginalExtension(),
                    'participantes' => $participantes,
                    'objetivo' => $data['objetivo']
                ]);
            }
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
