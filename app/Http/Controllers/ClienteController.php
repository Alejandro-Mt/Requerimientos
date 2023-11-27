<?php

namespace App\Http\Controllers;

use App\Models\acceso;
use App\Models\archivo;
use App\Models\Cliente;
use App\Models\comentario;
use App\Models\desfase;
use App\Models\estatu;
use App\Models\levantamiento;
use App\Models\motivo;
use App\Models\pausa;
use App\Models\planeacion;
use App\Models\pricli;
use App\Models\registro;
use App\Models\ronda;
use App\Models\sistema;
use App\Models\solpri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        Cliente::create([
            'nombre_cl' => $data['nombre_cl'],
            'abreviacion' => $data['abreviacion'],
        ]);
        return redirect(route('Seguir'));
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
        
        $listado = 
            cliente::
                orderby('nombre_cl')->get();
        
        $proyectos = 
            registro::
                select('registros.id_sistema','nombre_s')->
                join('sistemas as s','registros.id_sistema','s.id_sistema')->
                wherenotin('id_estatus',[18])->
                distinct()->
                orderby('nombre_s','asc')->
                get();
        
        return view('cliente.clientes',compact('proyectos'));
        #dd($listado);
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
    public function update(Request $data, $id_cliente)
    {
        $rename = $data->nombre_cl.'.'.pathinfo($data->file('logo')->getClientOriginalName(), PATHINFO_EXTENSION);
        $file = Storage::putFileAs("public/clientes", $data->file('logo'),$rename);
        $url = Storage::url($file);
        $update = Cliente::FindOrFail($id_cliente);
        $update->nombre_cl = $data['nombre_cl'];
        $update->abreviacion = $data['abreviacion'];
        $update->logo = $url;
        $update->save();  
        return redirect(route('Seguir'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_cliente)
    {
        $id_cliente = Cliente::find($id_cliente);
        $id_cliente->delete();
        return redirect(route('Seguir'));
    }

    public function document($folio)
    {
        $archivos = archivo::where('folio',Crypt::decrypt($folio))->get();
        $comentarios = 
          comentario::select ('nombre',
            'apaterno',
            'folio',
            'contenido',
            'p.puesto',
            'respuesta',
            'comentarios.created_at',
            'id_estatus',
            'avatar')
          ->leftjoin ('users as u','u.id','comentarios.usuario')
          ->leftjoin ('puestos as p', 'u.id_puesto','p.id_puesto')
          ->where('folio',Crypt::decrypt($folio))->get();
        $desfases = desfase::all();
        $estatus = estatu::orderby('posicion','asc')->get();
        $flujo = archivo::where('folio',Crypt::decrypt($folio))->where('url', 'like', '%Flujo de trabajo%')->count();
        $formatos = levantamiento::where('folio',Crypt::decrypt($folio))->count();
        $pausa = pausa::select('r.folio',pausa::raw('ifnull(max(pausas.pausa),0) as pausa'),'d.motivo')
          ->rightjoin('registros as r','r.folio', 'pausas.folio')
          ->leftjoin('desfases as d','d.id', 'pausas.id_motivo')
          ->where('r.folio',Crypt::decrypt($folio))
          ->groupby('r.folio')
          ->first();
        $registros= registro::
            select('registros.*',
              'es.titulo',
              'es.posicion',
              db::raw('ifnull(s.created_at,registros.created_at) as solicitud'),
              db::raw('if(s.folior IS NULL, registros.created_at, s.updated_at) as asignado'),
              db::raw("concat(nombre_r,' ', apellidos) as autorizador"),
              'fechaaut',
              'p.evidencia as def',
              'fecha_def',
              'prioridad',
              'fechades',
              'l.created_at as planteamiento',
              'l.updated_at as correo',
              db::raw('ifnull(l.fechaaut, p.created_at) as planeacion'),
              'a.created_at as analisis',
              'c.created_at as construccion',
              'li.created_at as liberacion',
              'li.evidencia_p as evidencia',
              'i.created_at as implementacion',
              'i.updated_at as implementado',
              DB::raw('CalcDias(ifnull(s.created_at, registros.created_at), ifnull(ifnull(l.fechaaut, c.created_at),now())) as lev'),
              DB::raw('CalcDias(ifnull(l.fechaaut, p.created_at), ifnull(c.updated_at,now())) as cons'),
              DB::raw('CalcDias(c.updated_at, ifnull(li.updated_at,now())) as lib'),
              DB::raw('CalcDias(li.updated_at, ifnull(i.updated_at,now())) as imp'),
              DB::raw('CalcDias(ifnull(s.created_at, registros.created_at), ifnull(i.updated_at,now())) as activo'),
              DB::raw('SUM(CASE WHEN pa.pausa != 0 THEN CalcDias(pa.created_at, CURDATE()) ELSE CalcDias(pa.created_at, pa.updated_at) END) as pospuesto'),
              //db::raw('DATEDIFF(ifnull(ifnull(l.fechaaut, c.created_at), now()), ifnull(s.created_at, registros.created_at)) - (DATEDIFF(ifnull(ifnull(l.fechaaut, c.created_at), now()), ifnull(s.created_at, registros.created_at)) DIV 7) * 2 - CASE WHEN WEEKDAY(ifnull(s.created_at, registros.created_at)) = 5 THEN 1 ELSE 0 END - CASE WHEN WEEKDAY(ifnull(ifnull(l.fechaaut, c.created_at),now())) = 6 THEN 1 ELSE 0 END AS lev'),
              //db::raw('DATEDIFF(ifnull(li.created_at,now()), ifnull(l.fechaaut, p.created_at))  - (DATEDIFF(ifnull(li.created_at,now()), ifnull(l.fechaaut, p.created_at)) DIV 7) * 2 - CASE WHEN WEEKDAY(ifnull(l.fechaaut, p.created_at)) = 5 THEN 1 ELSE 0 END - CASE WHEN WEEKDAY(ifnull(li.created_at,now())) = 6 THEN 1 ELSE 0 END AS cons'),
              //db::raw('DATEDIFF(ifnull(i.created_at,now()), li.created_at) - (DATEDIFF(ifnull(i.created_at,now()), li.created_at) DIV 7) * 2 - CASE WHEN WEEKDAY(li.created_at) = 5 THEN 1 ELSE 0 END - CASE WHEN WEEKDAY(ifnull(i.created_at,now())) = 6 THEN 1 ELSE 0 END AS lib'),
              //db::raw('DATEDIFF(ifnull(i.updated_at,now()), i.created_at) - (DATEDIFF(ifnull(i.updated_at,now()), i.created_at) DIV 7) * 2 - CASE WHEN WEEKDAY(i.created_at) = 5 THEN 1 ELSE 0 END - CASE WHEN WEEKDAY(ifnull(i.updated_at,now())) = 6 THEN 1 ELSE 0 END AS imp'),
              //db::raw('DATEDIFF(ifnull(i.updated_at,now()), ifnull(s.created_at, registros.created_at)) + 1 - (DATEDIFF(ifnull(i.updated_at,now()), ifnull(s.created_at, registros.created_at)) DIV 7) * 2 - CASE WHEN WEEKDAY(ifnull(s.created_at, registros.created_at)) = 5 THEN 1 ELSE 0 END - CASE WHEN WEEKDAY(ifnull(i.updated_at,now())) = 6 THEN 1 ELSE 0 END AS activo'),
              //db::raw('SUM(CASE WHEN pa.pausa != 0 THEN DATEDIFF(CURDATE(), pa.created_at) + 1 - (DATEDIFF(CURDATE(), pa.created_at) DIV 7) * 2 - CASE WHEN WEEKDAY(pa.created_at) = 5 THEN 1 ELSE 0 END - CASE WHEN WEEKDAY(CURDATE()) = 6 THEN 1 ELSE 0 END ELSE CASE WHEN pa.created_at IS NOT NULL AND pa.updated_at IS NOT NULL THEN DATEDIFF(pa.updated_at, pa.created_at) + 1 - (DATEDIFF(pa.updated_at, pa.created_at) DIV 7) * 2 - CASE WHEN WEEKDAY(pa.created_at) = 5 THEN 1 ELSE 0 END - CASE WHEN WEEKDAY(pa.updated_at) = 6 THEN 1 ELSE 0 END ELSE 0 END END) AS pospuesto'),
              'l.impacto')->
            leftjoin('estatus as es','es.id_estatus','registros.id_estatus')->
            leftjoin('solicitudes as s','registros.folio','s.folior')-> 
            leftjoin('levantamientos as l','registros.folio','l.folio')->
            leftjoin('responsables as re','re.id_responsable','l.autorizacion')->
            leftjoin('planeacion as p','registros.folio','p.folio')->
            leftjoin('analisis as a','registros.folio','a.folio')->
            leftjoin('construccion as c','registros.folio','c.folio')->
            leftjoin('liberaciones as li','registros.folio','li.folio')->
            leftjoin('implementaciones as i','registros.folio','i.folio')->
            leftjoin('pausas as pa','registros.folio','pa.folio')->
            where('registros.folio',Crypt::decrypt($folio))->
            first();
        $reg = planeacion::where('folio',Crypt::decrypt($folio))->exists();
        $retrasos = DB::table('pausas as p')
            ->select('p.folio', 'p.pausa',
                DB::raw('IFNULL(d.motivo, "DESCONOCIDO") AS motivo'),
                DB::raw('IFNULL(e.titulo, "DESCONOCIDO") AS titulo'),
                DB::raw('CASE WHEN p.pausa = 2 THEN CalcDias(p.created_at, CURDATE()) ELSE CalcDias(p.created_at, p.updated_at) END AS dias'))
            ->leftJoin('estatus as e', 'e.id_estatus', '=', 'p.id_estatus')
            ->leftJoin('desfases as d', 'd.id', '=', 'p.id_motivo')        
          ->where('folio', Crypt::decrypt($folio))
          ->get();
        $cancelar = motivo::all();
        $def_ver = archivo::where('folio',Crypt::decrypt($folio))->where('url', 'LIKE', '%Definición%')->get();
        if($reg){$link = planeacion::select('evidencia')->where('folio',Crypt::decrypt($folio))->first();}else{$link = NULL;}
        $rondas = ronda::selectRaw('max(ronda) as ronda, sum(aprobadas) as aprobadas, sum(rechazadas) as rechazadas')->where('folio',Crypt::decrypt( $folio))->first();    
        return view('cliente.documentacion',compact('archivos','comentarios','desfases','estatus','flujo','folio','formatos','link', 'cancelar','pausa','registros','retrasos','rondas','def_ver'));
        #dd(Crypt::decrypt($folio) );
    }

    public function priority($id)
    {
        //
        $orden = solpri::where([['estatus', 'autorizado'],['id_cliente',Crypt::decrypt($id)]])->orderby('id','desc')->first();
        $validar = solpri::where([['estatus', 'autorizado'],['id_cliente',Crypt::decrypt($id)]])->count();
        $listado = solpri::where('id_sistema', Crypt::decrypt($id))->where('estatus', 'autorizado')->selectRaw('GROUP_CONCAT(orden) as listado')->first();
        $clientes = 
            registro::
                select('cl.id_cliente','cl.nombre_cl')->
                join('clientes as cl', 'registros.id_cliente','cl.id_cliente')->
                where('registros.id_sistema',Crypt::decrypt($id))->
                wherein('registros.id_sistema',acceso::select('id_sistema')->where('id_user',Auth::user()->id))->
                distinct()->
                get();
        if($listado->listado){
            $ordenArray = explode(',', $listado->listado);
            $pendientes = 
            registro::
                join('clientes as cl','cl.id_cliente','registros.id_cliente')
                ->join('estatus as e','e.id_estatus','registros.id_estatus')
                ->wherenotin('registros.id_estatus',[13,14,18])
                ->wherenotin('folio',pausa::select('folio')->where('pausa',2)->distinct())
                ->where('registros.id_sistema', Crypt::decrypt($id))
                ->wherein('registros.id_sistema',acceso::select('id_sistema')->where('id_user',Auth::user()->id))
                ->orderbyRaw("FIELD(registros.folio,'" . implode("','", $ordenArray) . "') desc")
                ->orderby('registros.id_cliente')
                ->get();
        }else{
            $pendientes = 
                registro::
                    join('clientes as cl','cl.id_cliente','registros.id_cliente')
                    ->join('estatus as e','e.id_estatus','registros.id_estatus')
                    ->wherenotin('registros.id_estatus',[13,14,18])
                    ->wherenotin('folio',pausa::select('folio')->where('pausa',2)->distinct())
                    ->where('registros.id_sistema', Crypt::decrypt($id))
                    ->wherein('registros.id_sistema',acceso::select('id_sistema')->where('id_user',Auth::user()->id))
                    ->orderby('registros.id_cliente')
                    ->orderby('e.posicion', 'desc')
                    ->get();
        }
        $implementados = 
            registro::
                join('clientes as cl','cl.id_cliente','registros.id_cliente')
                ->where('registros.id_estatus','18')
                ->where('registros.id_sistema', Crypt::decrypt($id))
                ->wherein('registros.id_sistema',acceso::select('id_sistema')->where('id_user',Auth::user()->id))
                ->get();
        $pospuestos = 
            registro::
                join('clientes as cl','cl.id_cliente','registros.id_cliente')
                ->wherein(
                    'folio',
                    pausa::select('folio')
                    ->where('pausa',2)
                    ->where('registros.id_sistema', Crypt::decrypt($id))
                    ->distinct()
                )
                ->orwhere('registros.id_estatus',13)
                ->where('registros.id_sistema', Crypt::decrypt($id))
                ->wherein('registros.id_sistema',acceso::select('id_sistema')->where('id_user',Auth::user()->id))
                ->get();
        $sistemas = 
            registro::
                select('registros.id_sistema','nombre_s')->
                join('sistemas as s','registros.id_sistema','s.id_sistema')->
                wherenotin('id_estatus',[18])->
                distinct()->
                orderby('nombre_s','asc')->
                get();
        return view('cliente.prioridad',compact('clientes','implementados','orden','pendientes','pospuestos','validar','sistemas'));
        #dd($listado->listado);
    }
    public function request(Request $data)
    {
        $this->validate($data, [
            'solicitante' => 'required',
            'id_sistema' => 'required'
        ]);
        solpri::create([
            'id_cliente' => $data['id_cliente'],
            'orden' => implode(',', $data['orden']),
            'solicitante' => $data['solicitante'],
            'id_sistema' => $data['id_sistema']
        ]);
        #return redirect(route('Prioridad',$data['id_cliente']));
        $destino = 
            db::
                table('users as u')->
                select('email')->
                join('accesos as a','u.id','a.id_user')->
                where([['a.id_sistema','=',$data['id_sistema']],['u.id_puesto','>',3]])->get(); 
        #mail::to($destino->plick('email'))->send(new ActualizacionPrioridades($data)); 
    }

    public function importance()
    {
        //
        $proyectos = 
            sistema::
                orderby('nombre_s')->get();
        
        $listado = 
            registro::
                select('registros.id_cliente','nombre_cl','id_sistema')->
                join('clientes as cl','registros.id_cliente','cl.id_cliente')->
                wherenotin('id_estatus',[18])->
                distinct()->
                get();
        
        return view('cliente.importancia',compact('listado','proyectos'));
        //dd($listado);
    }
    public function updimp(request $data)
    {
        $this->validate($data, [
            'id_sistema' => 'required'
        ]);
        pricli::create([
            'id_sistema' => $data['id_sistema'],
            'orden' => implode(',', $data['orden']),
            'id_user' => Auth::user()->id
        ]);
        dd($data);

    }
    /*public function reportedoc(Request $data){
        $datos = $data->get('data');
        $header = $datos['header'];
        $folios = $datos['body'];
        #$ruta = '\Users\alejandro.garcia\Documents\PHP\web\credentials.json';
        $ruta = base_path('credentials.json');
        
        foreach ($folios as &$fila) {
            foreach ($fila as &$valor) {
                if ($valor === null) {
                    $valor = "";
                }
            }
        }
        
        // Crea el cliente y autenticación
        $client = new Google_Client();
        $client->setAuthConfig($ruta);
        $token = Auth::user()->token_google; // Implementa tu propia función para cargar el token almacenado
        $client->setAccessToken($token);
        $service = new Sheets($client);
    
        // Crea la hoja de cálculo
        $spreadsheet = new Spreadsheet([
            'properties' => [
                'title' => 'Registro de folios'
            ]
        ]);
        $spreadsheet = $service->spreadsheets->create($spreadsheet);
        $fileId = $spreadsheet->spreadsheetId;
        // Divide los registros en lotes de 100
        
        $values = [$header];
        foreach ($folios as $filas) {
            $values [] = $filas;
        };
        $body = new ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'RAW'
        ];
        $insert = [
            "insertDataOption" => "INSERT_ROWS"
        ];

        $result = $service->spreadsheets_values->append(
            $fileId,
            'Hoja 1',
            $body,
            $params,
            $insert
        );
        
        if ($result->error) {
            echo "Error: " . $result->error->message;
        } else {
            if ($result->updates->updatedRows > 0) {
                // Abre el archivo de Excel en el navegador
            
                $spreadsheetLink = "https://docs.google.com/spreadsheets/d/$fileId";
                if (stristr(PHP_OS, 'linux')) {
                    // Utiliza el comando xdg-open para abrir el enlace en el navegador predeterminado de Linux
                    exec("xdg-open \"$spreadsheetLink\"");
                } else {
                    // Maneja otros sistemas operativos aquí (por ejemplo, Windows)
                    // Puedes usar shell_exec u otros comandos según corresponda
                    // Por ejemplo, en Windows podrías usar "start" para abrir el enlace
                    shell_exec("start $spreadsheetLink");
                }
            
            }             
        }
        #dd($body,$datos['body'],$folios);
    
    }*/
}