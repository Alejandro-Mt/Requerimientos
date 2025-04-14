<?php

namespace App\Http\Controllers\Soportes;

use App\Http\Controllers\Controller;
use App\Imports\TicketImport;
use App\Models\Cliente;
use App\Models\Comentario;
use App\Models\Estatus;
use App\Models\Incidencia;
use App\Models\Localidad;
use App\Models\Sistema;
use App\Models\SO;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Usr_data;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class RegistroMasivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arq = Usr_data::where('id_departamento',14)->get();
        $cc = Usr_data::where('id_departamento',9)->get();
        $clientes = Cliente::all();
        $estatus = Estatus::all();
        $incidencias = Incidencia::all();
        $tickets = session('tickets');
        $localidades = Localidad::all();
        $ops = Usr_data::where('id_departamento',28)->get();
        $pip = Usr_data::where('id_departamento',29)->get();
        $sistemas = Sistema::all();
        $sos = SO::all();
        $users = User::all();
        return view('soporte.carga',compact('arq','cc','clientes','estatus','incidencias', 'tickets','localidades','ops','pip','sistemas','sos','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        $data->validate([
            'cliente.*'         => 'required', 
            'localidad.*'    => 'required',
            'sistema.*'      => 'required',
            'sop.*'           => 'required',
            'incidencia.*'   => 'required',
            'email.*'  => 'required',
            'estatus.*'      => 'required'
        ], [
            // Mensajes de error personalizados
            'cliente.*.required'         => 'El campo cliente es obligatorio.',
            'localidad.*.required'    => 'El campo localidad es obligatorio.',
            'sistema.*.required'      => 'El campo sistema es obligatorio.',
            'sop.*.required'           => 'El campo sistema operativo es obligatorio.',
            'incidencia.*.required'   => 'El campo incidencia es obligatorio.',
            'email.*.required'  => 'El campo solicitante es obligatorio.',
            'estatus.*.required'      => 'El campo estatus es obligatorio.'
        ]);
        $responsable = Auth::user()->id_user;
        foreach ($data['fecha_soporte'] as $key => $value) {

            $fecha_soporte = Carbon::createFromFormat('d-m-Y H:i', $data['fecha_soporte'][$key])->format('Y-m-d H:i:s');
            $ticket = Ticket::create([
                'fecha_reporte'     => $fecha_soporte,
                'id_cliente'        => $data['cliente'][$key],
                'id_localidad'      => $data['localidad'][$key],
                'id_sistema'        => $data['sistema'][$key],
                'id_so'             => $data['sop'][$key],
                'id_incidencia'     => $data['incidencia'][$key],
                'id_solicitante'    => $data['email'][$key],
                'nivel'             => '2',
                'id_estatus'        => $data['estatus'][$key],
                #'id_departamento'   => $solicitante->usrdata->id_departamento,
                #'id_cc'             => $data['id_cc'],
                'id_pip'            => $responsable
            ]);
            Comentario::Create(
                [
                  'folio'     => $ticket->folio,
                  'id_user'   => $data['email'][$key],
                  'comentario'=> $data['comentario'][$key],
                  'tipo'      => 'padre',
                  'id_estatus'=> $data['estatus'][$key]
                ]
            );
        }
        $data->session()->put('tickets', null);
        return redirect('/')->with('success', '¡Los tickets se han creado exitosamente!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
        $file = $data->file('adjunto');
        $import = new TicketImport;
        $datos = Excel::toArray($import, $file);
        if (!empty($datos)) {
            $tickets = $datos[0];
            // Mostrar los datos importados
            $data->session()->put('tickets', $tickets);
            return response()->json(['success' => true, 'redirect_url' => route('CM')]);
            #return session(['tickets' => $tickets]);
            #return redirect(route('CM'))->with('message','Importacion completada');
        } else {
            // Manejar el caso en que la importación falló
            return response()->json(['success' => false, 'error' => 'Error al importar el archivo'], 400);
        }
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
