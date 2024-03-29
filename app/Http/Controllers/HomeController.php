<?php

namespace App\Http\Controllers;

use App\Models\acceso;
use App\Models\registro;
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
        
        $tabla = registro::all();
                        
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
       
        $token = Auth::user()->token_google;
        if ($client->isAccessTokenExpired()) { 
            if (empty(Auth::user()->token_google)) {
                // Si no hay token, redirigir al usuario para autorizar
                $client->setRedirectUri(route('auth.google'));
                $authUrl = $client->createAuthUrl();
                return redirect()->away($authUrl);
            }
            /*try{
                $refreshToken = Auth::user()->token_google;
                
                #$refreshToken = $client->getRefreshToken();
                $client->fetchAccessTokenWithRefreshToken($refreshToken); 
                $token = $client->getAccessToken();
                dd($client->isAccessTokenExpired());   
            }
            catch(\Google\Service\Exception $e){
                dd($e->getCode());
            }*/
        }
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
        $response = ['fileId' => $fileId];
        return response()->json($response);
    }
}    