<?php

namespace App\Http\Controllers;

use App\Models\acceso;
use Google_Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;
use Google\Service\Sheets\Spreadsheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $tabla = db::table('registros as r')
                        ->select(
                            'r.id_registro',
                            'r.folio',
                            'descripcion',
                            db::raw("if(r.id_estatus != 14,if(pa.pausa = '2','POSPUESTO',e.titulo),e.titulo) as titulo"),
                            'cl.clase',
                            'l.prioridad',
                            'nombre_s',
                            db::raw("ifnull(CONCAT(ar.nombre_r,' ', ar.apellidos),'NO ASIGNADO') as Arquitecto"),
                            'nombre_cl',
                            db::raw("CONCAT(re.nombre_r,' ', re.apellidos) as nombre_r"),
                            db::raw("CONCAT(r.folio,' ', descripcion) as Bitrix"),
                            'r.created_at as solicitud',
                            'l.created_at as formato',
                            db::raw("TIMESTAMPDIFF(day,r.created_at,ifnull(l.created_at,now())) as Dif"),
                            'fechaaut as Autorizacion',
                            db::raw("ifnull(TIMESTAMPDIFF(day,l.created_at,ifnull(fechaaut,now())),0) as difAut"),
                            'fechades',
                            db::raw("ifnull(TIMESTAMPDIFF(day,l.fechaaut,ifnull(l.fechades,now())),0) as difdes"),
                            'p.fechaCompReqC',
                            'p.evidencia',
                            'p.fechaCompReqR',
                            db::raw("ifnull(TIMESTAMPDIFF(day,p.fechaCompReqC,ifnull(p.fechaCompReqR,now())),0) as diascomp"),
                            'df.motivo',
                            'p.motivopausa',
                            'p.evPausa',
                            'p.fechaReact',
                            'an.fechaCompReqC as envioAnalisis',
                            'dfa.motivo as motivodesfase',
                            db::raw("ifnull(TIMESTAMPDIFF(day,p.fechaCompReqR,ifnull(an.fechaCompReqC,now())),0) as diasAn"),
                            'an.fechaCompReqR as autCl',#revisar texto que se solicita en analisis
                            db::raw("ifnull(TIMESTAMPDIFF(day,an.fechaCompReqC,ifnull(an.fechaCompReqR,now())),0) as diasAut"),
                            'co.fechaCompReqC as fechaConst',
                            'dfc.motivo as motivoDC',
                            'i.solInfopip',
                            'i.solInfoC',
                            'i.respuesta',
                            'dfi.motivo as mri',
                            db::raw("ifnull(TIMESTAMPDIFF(day,i.solInfoC,ifnull(i.respuesta,now())),0) as diasInfo"),
                            'lib.fecha_lib_a',
                            'lib.fecha_lib_r',
                            db::raw("ifnull(TIMESTAMPDIFF(day,lib.fecha_lib_a,ifnull(lib.fecha_lib_r,now())),0) as diasL"),
                            'lib.inicio_lib',
                            db::raw("ifnull(TIMESTAMPDIFF(day,lib.fecha_lib_r,ifnull(lib.inicio_lib,now())),0) as diasInicioL"),
                            'lib.inicio_p_r',
                            db::raw("ifnull(TIMESTAMPDIFF(day,lib.inicio_lib,ifnull(lib.inicio_p_r,now())),0) as diasPL"),
                            'lib.t_pruebas',
                            'lib.evidencia_p',
                            'imp.cronograma',
                            'imp.link_c',
                            'imp.f_implementacion',
                            'imp.estatus_f',
                            'imp.seguimiento',
                            'imp.comentarios',
                            db::raw("ifnull(TIMESTAMPDIFF(day,r.created_at,ifnull(f_implementacion,null)),0) as duracion"))
                            #db::raw("ifnull(TIMESTAMPDIFF(day,l.fechades,ifnull(p.fechaCompReqC,now())),0) as diasconf"))
                        ->join('sistemas as s','r.id_sistema', 's.id_sistema')
                        ->join('responsables as re','r.id_responsable','re.id_responsable')
                        ->join('clientes as c','c.id_cliente','r.id_cliente')
                        ->join('estatus as e', 'e.id_estatus','r.id_estatus')
                        ->leftJoin('clases as cl', 'cl.id_clase','r.id_clase')
                        ->leftjoin('responsables as ar','r.id_arquitecto','ar.id_responsable')
                        ->leftjoin('levantamientos as l','r.folio','l.folio')
                        ->leftJoin('planeacion as p', 'r.folio','p.folio')
                        ->leftjoin('desfases as df', 'p.motivodesfase', 'df.id')
                        ->leftJoin('analisis as an', 'r.folio', 'an.folio')
                        ->leftjoin('desfases as dfa', 'an.motivodesfase', 'dfa.id')
                        ->leftJoin('construccion as co', 'r.folio', 'co.folio')
                        ->leftJoin('desfases as dfc', 'co.motivodesfase', 'dfc.id')
                        ->leftJoin('informacion as i', 'r.folio','i.folio')
                        ->leftJoin('desfases as dfi', 'i.motivoRetrasoInfo', 'dfi.id')
                        ->leftJoin('liberaciones as lib', 'r.folio', 'lib.folio')
                        ->leftJoin('implementaciones as imp', 'r.folio', 'imp.folio')
                        ->leftJoin('pausas as pa', 'r.folio', 'pa.folio')
                        ->orderBy('r.id_registro','asc')
                        ->groupBy('r.folio')
                        ->get();
                        
        $requerimientos = 
            db::table('solicitudes as s')->
            select('id_sistema', db::raw('COUNT(folio) as total'))->
            where('s.correo',Auth::user()->email)->
            groupBy('id_sistema')->
            get();
        if(Auth::user()->id_area == 3){
          $sistemas = 
            db::table('solicitudes as s')->
            select('*', db::raw('COUNT(s.id_sistema) as total'))->
            join('sistemas as si','si.id_sistema','s.id_sistema')->
            leftjoin('registros as r','r.folio','s.folior')->
            where('s.correo',Auth::user()->email)->
            whereNotIn('r.id_estatus',['14','18'])->
            groupBy('si.id_sistema')->
            get();
        }else{
          $sistemas = 
            db::table('registros as r')->
            select('*', db::raw('COUNT(r.id_sistema) as total'))->
            join('sistemas as si','si.id_sistema','r.id_sistema')->
            #leftjoin('registros as r','r.folio','s.folior')->
            wherein('r.id_sistema',acceso::select('id_sistema')->where('id_user',Auth::user()->id))->
            whereNotIn('r.id_estatus',['14','18'])->
            groupBy('si.id_sistema')->
            get();
        }
        $SxR = db::table('registros as r')
                    ->select("s.nombre_s",
                        db::raw("count(r.id_sistema) as total"))
                    ->join('sistemas as s','r.id_sistema','s.id_sistema')
                    ->wherenotin('r.id_estatus',['18','14'])
                    ->wherein('s.id_sistema',acceso::select('id_sistema')->where('id_user',Auth::user()->id))
                    ->groupBy('s.nombre_s')
                    ->orderBy('s.nombre_s')
                    ->get();
        $cerrado = db::table('registros as r')
                    ->select("s.nombre_s",
                        db::raw("count(r.id_sistema) as total"))
                    ->join('sistemas as s','r.id_sistema','s.id_sistema')
                    ->wherein('r.id_estatus',['18'])
                    ->wherein('s.id_sistema',acceso::select('id_sistema')->where('id_user',Auth::user()->id))
                    ->groupBy('s.nombre_s')
                    ->orderBy('s.nombre_s')
                    ->get();
        $responsables = db::table('registros as r')
                    ->select(db::raw("concat(re.nombre_r,' ',re.apellidos) as name"),
                            db::raw("group_concat(r.id_cliente) as data"))
                    ->join('responsables as re','r.id_responsable','re.id_responsable')
                    ->groupBy('re.nombre_r')
                    ->orderBy('re.nombre_r')
                    ->get();
        $clientes = db::table('registros as r')
                    ->select('c.nombre_cl')
                    ->join('clientes as c','r.id_cliente','c.id_cliente')
                    ->orderBy('c.nombre_cl')
                    ->get();                    
        return view('principal',compact('tabla','SxR','responsables','clientes','requerimientos','sistemas','cerrado'));
        #dd($sistemas);
    }

    
    public function gsheets(Request $data){
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
            
                if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                    // Si el servidor se está ejecutando en Windows
                    shell_exec("start $spreadsheetLink"); // Esto abre el enlace en el navegador predeterminado en Windows
                } else {
                    // Si el servidor no se está ejecutando en Windows (asume Unix)
                    // Intenta usar xdg-open o gnome-open según el entorno
                    if (strpos(shell_exec('which xdg-open'), 'xdg-open') !== false) {
                        shell_exec("xdg-open '$spreadsheetLink'");
                    } elseif (strpos(shell_exec('which gnome-open'), 'gnome-open') !== false) {
                        shell_exec("gnome-open '$spreadsheetLink'");
                    } else {
                        // Si ninguno de los comandos está disponible, puedes mostrar un mensaje o registrar un error.
                        echo "No se pudo abrir el enlace en el navegador.";
                    }
                }
            }             
        }
        #dd($body,$datos['body'],$folios);
    
    }
}    