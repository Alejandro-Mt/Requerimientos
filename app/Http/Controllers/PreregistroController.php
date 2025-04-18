<?php

namespace App\Http\Controllers;

use App\Mail\Cliente\SolicitudRequerimiento;
use App\Models\acceso;
use App\Models\archivo;
use App\Models\clase;
use App\Models\estatu;
use App\Models\Cliente;
use App\Models\registro;
use App\Models\responsable;
use App\Models\sistema;
use App\Models\solicitud;
use App\Models\User;
use App\Models\usr_data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use DateTime;
use Illuminate\Support\Facades\Auth;

class PreregistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clases = clase::all();
        $cliente = db::table('clientes')->orderby('nombre_cl', 'asc')->get();
        $estatus = estatu::all();
        $id = solicitud::latest('id')->first();
        $registros = solicitud::where('folio', 'like', 'PIP%')->count();
        $responsable = User::activos()->orderby('nombre', 'asc')->get();
        $sistema = sistema::orderby('nombre_s', 'asc')->get();
        $vacio = solicitud:: select('*')->count();
        return view('formatos.requerimientos.preregistro.preregistro',compact('clases','cliente','estatus','id','registros','responsable','sistema','vacio'));
        #dd($id->id+1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        $y = new DateTime('NOW');
        $y = $y->format('y');
        $registros = solicitud::where('folio','like',"$data[folio]%")->count();
        $registros = $registros + 1;
        $folio = "$data[folio]-$registros";
        $coordinacion = usr_data::select('email')
            ->leftJoin('users as u', 'u.id', 'usr_data.id_user')
            ->leftJoin('puestos as p', 'p.id_puesto', 'usr_data.id_puesto')
            ->leftJoin('accesos as a', 'usr_data.id_user', 'a.id_user')
            ->whereIn('jerarquia', [2, 3, 7])
            ->where('a.id_sistema', $data['id_sistema'])
            ->where(function ($query) {
                $query->where('usr_data.id_area', '!=', '12')->orWhere('jerarquia', '7');
            })
        ->get();
        $this->validate($data, [
            'descripcion' => "max:250",
        ]);
        $data['email'] = Auth::user()->email;
        solicitud::create([
            'folio' => $folio,
            'solicitante' => Auth::user()->nombre.' '.Auth::user()->apaterno.' '.Auth::user()->amaterno,
            'correo' => $data['email'] ,
            'id_cliente' => $data['id_cliente'],
            'id_sistema' => $data['id_sistema'],
            'id_estatus' => 20,
            'descripcion' => $data['descripcion'],
            'planteamiento' => $data['planteamiento']
        ]);
        foreach ($coordinacion as $usuario) {
            //$notificacionUser = Http::get('https://api-seguridadv2.tiii.mx/api/v1/login/validacionRF/0/'.$usuario->email);
            $notificacionUser = Http::get('https://api-seguridad-67vdh6ftzq-uc.a.run.app/api/v1/login/validacionRF/0/' . $usuario->email);
            $datos = $notificacionUser->json(); // Convierte la respuesta JSON a un array PHP
            $idSC = $datos['idUsuario'];
            $message = 'Hola! Te informamos que tienes una Nueva Solicitud de requerimiento ~https://requerimientos.tiii.mx/preregistro.listado~. Gracias.';
            $notificacionController = new NotificacionController();
            $notificacionController->stnotify($idSC,$message);
        }
        mail::to($data['email'])->cc( $coordinacion->pluck('email'))->send(new SolicitudRequerimiento($folio));
        if($data['adjunto'] == 'true'){
            return redirect(route('Plus',$folio));
        }
        else{
           return redirect(route('home'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function store(){ 
        $archivos = archivo::select('folio')->distinct()->get();
        $clientes = Cliente::all();
        $estatus = estatu::all();
        $sistemas = sistema::all();
        $solicitudes = solicitud::
            select('solicitudes.*',db::raw('if(a.folio = solicitudes.folio,"si","no") as adjunto'))
            ->leftjoin('archivos as a','solicitudes.folio','a.folio')
            ->where(
                db::raw('EXTRACT(year FROM solicitudes.created_at)'), 
                db::raw('EXTRACT(year FROM now())')
            )
            ->wherein('solicitudes.id_sistema',acceso::select('id_sistema')->where('id_user',Auth::user()->id))
            ->distinct()
            ->orderby('solicitudes.id','desc')
            ->get();
        return view('formatos.requerimientos.preregistro.store',compact('archivos','clientes','estatus','sistemas','solicitudes'));
    }

    function upload($folio){
        return view('formatos.requerimientos.preregistro.carga',compact('folio'));
    }

    /**
     * data a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function data(Request $data,$folio){ 
        #$folio = solicitud::FindOrFail($id);
        #revisar problema con archivos con mismo nombre
        $rename = $data->file('adjunto')->getClientOriginalName();
        $data->validate(['adjunto'=>'required']);{
        $files = Storage::putFileAs("public/temporal/temp-$folio", $data->file('adjunto'),$rename);
        $url = Storage::url($files);
        if(archivo::where('url', 'like', '%' . $rename . '%')->count() == 0)
            archivo::create([
                'folio'=>$folio,
                'url'=>$url
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($folio)
    {
        //
        $archivos = archivo::where('folio',$folio)->get();
        return view('formatos.requerimientos.preregistro.archivos',compact('archivos'));
        #dd($archivos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($folio)
    {
        $datos = solicitud::where('folio',$folio)->get();
        $clases = clase::all();
        $cliente = db::table('clientes')->orderby('id_cliente', 'asc')->get();
        $estatus = estatu::all();
        $proyectos = registro::where('folio', 'like', 'PR-PIP%')->get();
        $registros = registro::where('folio', 'like', 'PIP%')->count();
        $responsable = User::activos()->orderby('nombre', 'asc')->get();
        $sistema = sistema::all();
        $vacio = registro:: select('*')->count();
        return view('formatos.requerimientos.new',compact('clases','cliente','datos','estatus','proyectos','registros','responsable','sistema','vacio'));
        #dd($registros);
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($folio)
    {
        $folio = solicitud::where('folio',$folio)->first();
        $folio->id_estatus = 22;
        $folio->save();
    }

    /*public function chart()
    {
        # chart
        $estatus = db::table('registros as r')
                    ->select('titulo')
                    ->join('estatus as e','r.id_estatus','e.id_estatus')
                    ->groupBy('e.id_estatus')
                    ->orderBy('titulo')
                    ->get();

        $SxR = db::table('registros as r')
                    ->select(db::raw("concat(re.nombre,' ',re.apellidos) as name"),
                            #db::raw("group_concat(r.id_cliente) as data")
                            db::raw("count(r.id_responsable) as y"))
                    ->join('users as re','r.id_responsable','re.id')
                    ->groupBy('re.nombre_r')
                    ->orderBy('re.nombre_r')
                    ->get();
        ### selects para grafico de responsables ###
        $RxR = db::table('registros as r')
                    ->select(db::raw("concat(re.nombre_r,' ',re.apellidos) as name"),
                            db::raw("group_concat(r.folio) as data"))
                    ->join('responsables as re','r.id_responsable','re.id_responsable')
                    ->groupBy('re.nombre_r')
                    ->orderBy('re.nombre_r')
                    ->get();
        $clientes = db::table('registros as r')
                    ->distinct()
                    ->select('c.nombre_cl as categories')
                    ->join('clientes as c','r.id_cliente','c.id_cliente')
                    ->orderBy('c.nombre_cl')
                    ->get();
    ### selects para grafico de clientes ###
        $RxC = db::table('registros as r')
                    ->select(db::raw("nombre_cl as name"),
                            db::raw("count(r.folio) as y"))
                    ->join('clientes as c','r.id_cliente','c.id_cliente')
                    ->groupBy('nombre_cl')
                    ->orderBy('nombre_cl')
                    ->get();
        $RxS = db::table('registros as r')
                    ->select(db::raw("nombre_s as name"),
                            db::raw("count(folio) as y"))
                    ->join('sistemas as s','r.id_sistema','s.id_sistema')
                    ->groupBy('nombre_s')
                    ->orderBy('nombre_s')
                    ->get();
        $ex = 
            db::
            table(
                db::
                table('registros as r')
                ->select(db::raw('COUNT(nombre_cl) name'), 'c.nombre_cl', 'e.titulo')
                ->join('clientes as c','c.id_cliente','r.id_cliente')
                ->join('estatus as e', 'e.id_estatus', 'r.id_estatus')
                ->groupBy('r.id_estatus', 'r.id_cliente'))->
            select(db::raw('nombre_cl name, group_concat(name) data'))
            ->groupBy('nombre_cl')
            ->orderBy('titulo')->get();
        $exa = db::
            table('registros as r')
            ->select(db::raw('count(id_registro) as total, e.titulo, c.nombre_cl'))
            ->join('clientes as c','c.id_cliente','r.id_cliente')
            ->join('estatus as e', 'e.id_estatus', 'r.id_estatus')
            ->groupBy('r.id_estatus', 'r.id_cliente')
            ->orderBy('nombre_cl')->get();
        return view('cliente.estadistico',compact('clientes','estatus','ex','exa','RxR','RxC','RxS','SxR'));
    }*/
}
