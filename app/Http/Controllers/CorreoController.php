<?php

namespace App\Http\Controllers;

use Google_Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;
use Google\Service\Sheets\Spreadsheet;
use App\Mail\SegundaValidacion;
use App\Mail\ValidacionCliente;
use App\Mail\ValidacionRequerimiento;
use App\Models\archivo;
use App\Models\comentario;
use App\Models\desfase;
use App\Models\estatu;
use App\Models\levantamiento;
use App\Models\liberacion;
use App\Models\pausa;
use App\Models\planeacion;
use App\Models\registro;
use App\Models\responsable;
use App\Models\sistema;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PDF;
use Exception;
use Mpdf\Mpdf;

class CorreoController extends Controller
{
    //
    
    public function send($folio){
        $estatus = Registro::where('folio', Crypt::decrypt($folio))->first();
        if($estatus->id_estatus == 10){
            $registro = levantamiento::
                select('d.email', DB::raw('GROUP_CONCAT(i.email) as cc'))->
                where('folio', Crypt::decrypt($folio))->
                leftJoin('responsables as d', 'levantamientos.autorizacion', 'd.id_responsable')->
                leftJoin('responsables as i', function ($join) {
                    $join->on('levantamientos.involucrados', 'like', DB::raw('CONCAT("%,", i.id_responsable, ",%")'))->
                    orWhere('levantamientos.involucrados', 'like', DB::raw('CONCAT("%,", i.id_responsable)'))->
                    orWhere('levantamientos.involucrados', 'like', DB::raw('CONCAT(i.id_responsable)'));
                })->
                first();
        }else
            if($estatus->id_estatus == 16){
                $registro = levantamiento::
                    select('d.email', DB::raw('GROUP_CONCAT(i.email) as cc'))->
                    where('levantamientos.folio', Crypt::decrypt($folio))->
                    leftJoin('registros as r', 'levantamientos.folio', 'r.folio')->
                    leftJoin('responsables as d', 'r.id_arquitecto', 'd.id_responsable')->
                    leftJoin('responsables as i', function ($join) {
                        $join->on('levantamientos.involucrados', 'like', DB::raw('CONCAT("%,", i.id_responsable, ",%")'))->
                        orWhere('levantamientos.involucrados', 'like', DB::raw('CONCAT("%,", i.id_responsable)'))->
                        orWhere('levantamientos.involucrados', 'like', DB::raw('CONCAT(i.id_responsable)'));
                    })->
                    first();
            }

        $archivos = archivo::where ('folio', Crypt::decrypt($folio))->get();
        return view('layouts.correo',compact('archivos','folio','registro','estatus'));
        #dd($registros);
    }

    public function sended(Request $data){
        $folio = Crypt::decrypt($data['folio']);
        $estatus = Registro::where('folio', $folio)->first();
        if($estatus->id_estatus == 10){
            $destinatarios = levantamiento::
                select('d.email', DB::raw('GROUP_CONCAT(i.email) as cc'))->
                where('folio', $folio)->
                leftJoin('responsables as d', 'levantamientos.autorizacion', 'd.id_responsable')->
                leftJoin('responsables as i', function ($join) {
                    $join->on('levantamientos.involucrados', 'like', DB::raw('CONCAT("%,", i.id_responsable, ",%")'))->
                    orWhere('levantamientos.involucrados', 'like', DB::raw('CONCAT("%,", i.id_responsable)'))->
                    orWhere('levantamientos.involucrados', 'like', DB::raw('CONCAT(i.id_responsable)'));
                })->
                first();
        }else
            if($estatus->id_estatus == 16){
                $destinatarios = levantamiento::
                    select('d.email', DB::raw('GROUP_CONCAT(i.email) as cc'))->
                    where('levantamientos.folio', $folio)->
                    leftJoin('registros as r', 'levantamientos.folio', 'r.folio')->
                    leftJoin('responsables as d', 'r.id_arquitecto', 'd.id_responsable')->
                    leftJoin('responsables as i', function ($join) {
                        $join->on('levantamientos.involucrados', 'like', DB::raw('CONCAT("%,", i.id_responsable, ",%")'))->
                        orWhere('levantamientos.involucrados', 'like', DB::raw('CONCAT("%,", i.id_responsable)'))->
                        orWhere('levantamientos.involucrados', 'like', DB::raw('CONCAT(i.id_responsable)'));
                    })->
                    first();
            }
        $archivos = Archivo::where('folio', $folio)->get();
        // Verificar si los archivos requeridos existen
        $requiredKeywords = ['gantt'];
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
        // Los archivos requeridos existen, proceder con el envío de correo y actualización de estatus
        $cc = explode(',', $destinatarios->cc);
        try{
        mail::to($data->email)->cc($cc)->send(new ValidacionCliente($folio));
        }catch(Exception $e) {}
        if (count(Mail::failures()) < 1) {
            $estatus->id_estatus = $data['id_estatus'];
            $estatus->save();
            $successMessage = "El correo ha sido enviado.";
            return redirect(route('Documentos', $data->folio))->with('success', $successMessage);
        } else {
            $errorMessage = "No se pudo enviar el correo. Vuelve a intentarlo.";
            return redirect(route('Documentos', $data->folio))->with('error', $errorMessage);
        }
    }

    protected function PDF($folio){
        $pdf = new Mpdf();
        $formato = db::table('registros as r')
                          ->select('l.created_at as fsol',
                                    'r.descripcion',
                                    'a.area',
                                    db::raw("concat(sol.nombre,' ',sol.a_pat,' ',ifnull(sol.a_mat,' ')) as solicitante"),
                                    'd.departamento',
                                    'jd.nombre_r as j_dep',
                                    's.nombre_s',
                                    'c.nombre_cl',
                                    'au.nombre_r as autorizo',
                                    'au.apellidos',
                                    'l.previo',
                                    'l.impacto',
                                    'l.problema',
                                    'l.general',
                                    'l.detalle',
                                    'l.esperado',
                                    'l.relaciones',
                                    'l.involucrados')
                          ->leftjoin('levantamientos as l', 'r.folio', 'l.folio')
                          ->leftJoin('areas as a', 'r.id_area','a.id_area')
                          ->leftJoin('departamentos as d','l.departamento','d.id')
                          ->leftJoin('responsables as jd','l.jefe_departamento','jd.id_responsable')
                          ->leftJoin('sistemas as s','r.id_sistema', 's.id_sistema')
                          ->leftJoin('clientes as c','c.id_cliente','r.id_cliente')
                          ->leftJoin('responsables as au','l.autorizacion','au.id_responsable')
                          ->leftJoin('solicitantes as sol','sol.id_solicitante','l.id_solicitante')
                          ->where('l.folio', Crypt::decrypt($folio))->get();
        $sistemas = sistema::all();
        $responsables = responsable::all();
        foreach($formato as $fold){
            $relaciones = explode(',',$fold->relaciones);
            $involucrados = explode(',',$fold->involucrados);
            $titulo = Crypt::decrypt($folio);
            #$pdf = mpdf::loadView('correos.Plantilla',compact('formato','involucrados','relaciones','responsables','sistemas'));
            #return $pdf -> stream ("$titulo $fold->descripcion.pdf");
            $html = view('correos.Plantilla',compact('formato','involucrados','relaciones','responsables','sistemas'));
            $pdf->WriteHTML($html);
            $nombreArchivo = 'Levantamiento.pdf';
    
            // Genera una respuesta HTTP con el PDF y descárgalo
            $pdf->Output($nombreArchivo, \Mpdf\Output\Destination::INLINE);
        }
    }

    protected function respuesta($folio){
        $hora = levantamiento::findOrFail($folio);
        $involucrados = DB::table('responsables as res')
        ->join('levantamientos as lev', function ($join) {
            $join->on(DB::raw('FIND_IN_SET(res.id_responsable, lev.involucrados)'), '>', DB::raw('0'));
        })
        ->where('lev.folio', $folio)
        ->get();
        $fol = registro::
                leftJoin('responsables as res','registros.id_responsable', 'res.id_responsable')
                ->where('registros.folio',$folio)
                ->first();
        if($hora->fechaaut == NULL){ 
            $hora -> fechaaut = now();
            $hora -> save();
                mail::to($fol->email)->cc($involucrados->pluck('email'))->send(new ValidacionRequerimiento($folio));
                return 'Se ha autorizado satisfactoriamente';   
        }else{
            if($fol->id_estatus == 9 && $hora->fecha_def == NULL){
                $hora -> fecha_def = now();
                $hora -> save();
                mail::to($fol->email)->cc($involucrados->pluck('email'))->send(new ValidacionRequerimiento($folio));
                return 'Se ha autorizado satisfactoriamente';   
            }else{
                return ('Ya ha sido autorizado');
            }
        }
    }

    public function rechazo($folio){
        $fol = registro::leftJoin('responsables as r','registros.id_responsable', 'r.id_responsable')
                      ->where('folio',$folio)
                      ->first();
        $coordinacion = User:: select('email')
        ->leftjoin('puestos as p','p.id_puesto','users.id_puesto')
        ->leftjoin('accesos as a','users.id','a.id_user')
        ->whereIn('jerarquia', [2, 3, 7])
        ->where('a.id_sistema',$fol->id_sistema)
        ->get();
        $hora = levantamiento::findOrFail($folio);
        //dd($fol,$coordinacion);
        if($hora->fechaaut == NULL){ 
            mail::to($fol->email)->cc($coordinacion->pluck('email'))->send(new ValidacionRequerimiento($folio));
            return 'Se ha enviado la respuesta, gracias.';
            #dd($correo->dispercion);  
        }else{
            if($hora->fecha_def == NULL){
                mail::to($fol->email)->cc($coordinacion->pluck('email'))->send(new ValidacionRequerimiento($folio));
                return 'Se ha enviado la respuesta, gracias.';   
            }else{
                return ('El folio ya ha sido autorizado, en caso de querer cancelarlo por favor contacte a soporte');
            }
        }
    }

    protected function impacto($folio,$impacto){
        $hora = levantamiento::findOrFail($folio);
        $correo = registro::select('res.email')
                      ->leftJoin('responsables as res','registros.id_responsable', 'res.id_responsable')
                      ->where('folio',$folio)
                      ->first();
        $involucrados = DB::
            table('responsables as res')->
            join('levantamientos as lev', function ($join) {
                $join->on(DB::raw('FIND_IN_SET(res.id_responsable, lev.involucrados)'), '>', DB::raw('0'));
            })->
            where('lev.folio', $folio)->
            get();
        if($hora->fechades == NULL){ 
            $hora -> fechades = now();
            $hora -> impacto = $impacto;
            $hora -> save();
            mail::to($correo->email)->cc($involucrados->pluck('email'))->send(new SegundaValidacion($folio));
            if(Auth::user()->id_area == '12' || Auth::user()->id_puesto == '7'){
                return redirect(route('Documentos',Crypt::encrypt($folio)));
            }else{
                return 'Se ha enviado la respuesta, gracias.'; 
            }   
        } else{
            return ('Ya ha sido definido');
            #dd($hora);
        }
        
    }

    /*public function reportedoc($folio){
        // Crea una nueva instancia de Dompdf
        $pdf = new Mpdf();

        // Opciones para el PDF (puedes personalizarlas según tus necesidades)
        /*$options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $pdf->setOptions($options);*
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
              db::raw('if(s.folior IS NULL, NULL, s.updated_at) as autorizado'),
              'fechaaut',
              'prioridad',
              'fechades',
              'l.created_at as planteamiento',
              'l.updated_at as correo',
              'p.created_at as planeacion',
              'a.created_at as analisis',
              'c.created_at as construccion',
              'li.created_at as liberacion',
              'li.evidencia_p as evidencia',
              'i.created_at as implementacion',
              'i.updated_at as implementado',
              db::raw('DATEDIFF(ifnull(l.fechades, now()), ifnull(s.created_at, registros.created_at)) - (DATEDIFF(ifnull(l.fechades, now()), ifnull(s.created_at, registros.created_at)) DIV 7) * 2 - CASE WHEN WEEKDAY(ifnull(s.created_at, registros.created_at)) = 5 THEN 1 ELSE 0 END - CASE WHEN WEEKDAY(ifnull(l.fechades,now())) = 6 THEN 1 ELSE 0 END AS lev'),
              db::raw('DATEDIFF(ifnull(li.created_at,now()), p.created_at)  - (DATEDIFF(ifnull(li.created_at,now()), p.created_at) DIV 7) * 2 - CASE WHEN WEEKDAY(p.created_at) = 5 THEN 1 ELSE 0 END - CASE WHEN WEEKDAY(ifnull(li.created_at,now())) = 6 THEN 1 ELSE 0 END AS cons'),
              db::raw('DATEDIFF(ifnull(i.created_at,now()), li.created_at) - (DATEDIFF(ifnull(i.created_at,now()), li.created_at) DIV 7) * 2 - CASE WHEN WEEKDAY(li.created_at) = 5 THEN 1 ELSE 0 END - CASE WHEN WEEKDAY(ifnull(i.created_at,now())) = 6 THEN 1 ELSE 0 END AS lib'),
              db::raw('DATEDIFF(ifnull(i.updated_at,now()), i.created_at) - (DATEDIFF(ifnull(i.updated_at,now()), i.created_at) DIV 7) * 2 - CASE WHEN WEEKDAY(i.created_at) = 5 THEN 1 ELSE 0 END - CASE WHEN WEEKDAY(ifnull(i.updated_at,now())) = 6 THEN 1 ELSE 0 END AS imp'),
              db::raw('DATEDIFF(ifnull(i.updated_at,now()), ifnull(s.created_at, registros.created_at)) + 1 - (DATEDIFF(ifnull(i.updated_at,now()), ifnull(s.created_at, registros.created_at)) DIV 7) * 2 - CASE WHEN WEEKDAY(ifnull(s.created_at, registros.created_at)) = 5 THEN 1 ELSE 0 END - CASE WHEN WEEKDAY(ifnull(i.updated_at,now())) = 6 THEN 1 ELSE 0 END AS activo'),
              db::raw('SUM(CASE WHEN pa.created_at IS NOT NULL AND pa.updated_at IS NOT NULL THEN DATEDIFF(pa.updated_at, pa.created_at) + 1 - (DATEDIFF(pa.updated_at, pa.created_at) DIV 7) * 2 - CASE WHEN WEEKDAY(pa.created_at) = 5 THEN 1 ELSE 0 END - CASE WHEN WEEKDAY(pa.updated_at) = 6 THEN 1 ELSE 0 END ELSE 0 END) AS pospuesto'),
              'l.impacto'
            )->
            leftjoin('estatus as es','es.id_estatus','registros.id_estatus')->
            leftjoin('solicitudes as s','registros.folio','s.folior')-> 
            leftjoin('levantamientos as l','registros.folio','l.folio')->
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
          ->select('p.folio', 'p.pausa', 'd.motivo', 'e.titulo')
          ->selectRaw('CASE WHEN p.created_at IS NOT NULL AND p.updated_at IS NOT NULL THEN DATEDIFF(p.updated_at, p.created_at) + 1 - (DATEDIFF(p.updated_at, p.created_at) DIV 7) * 2 - CASE WHEN WEEKDAY(p.created_at) = 5 THEN 1 ELSE 0 END - CASE WHEN WEEKDAY(p.updated_at) = 6 THEN 1 ELSE 0 END ELSE 0 END AS dias')
          ->leftJoin('estatus as e', 'e.id_estatus', '=', 'p.id_estatus')
          ->leftJoin('desfases as d', 'd.id', '=', 'p.id_motivo')
          ->where('folio', Crypt::decrypt($folio))
          ->get();
        if($reg){$link = planeacion::select('evidencia')->where('folio',Crypt::decrypt($folio))->first();}else{$link = NULL;}
        $html = view('cliente.documentacion',compact('archivos','comentarios','desfases','estatus','folio','formatos','link','pausa','registros','retrasos'));
        

        // Genera el contenido HTML para el PDF (debe ser tu HTML)
        //$html = view('cliente\documentacion',Crypt::decrypt($folio))->render();

        // Carga el contenido HTML en Dompdf
        $pdf->WriteHTML($html);

        // Renderiza el PDF
        //$pdf->render();

        // Establece el nombre del archivo de salida
        $nombreArchivo = $folio.'.pdf';

        // Genera una respuesta HTTP con el PDF y descárgalo
        $pdf->Output($nombreArchivo, \Mpdf\Output\Destination::INLINE);
    }
    public function reportedoc(Request $data){
        $datos = $data->get('data');
        $header = ['test'];
        $folios = 'test';
        $ruta = base_path('credentials.json');
        
        //foreach ($folios as &$fila) {
        //    foreach ($fila as &$valor) {
        //        if ($valor === null) {
        //            $valor = "";
        //        }
        //    }
        //}
        
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
        //foreach ($folios as $filas) {
        //    $values [] = $filas;
        //};
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
                //if (stristr(PHP_OS, 'linux')) {
                    // Utiliza el comando xdg-open para abrir el enlace en el navegador predeterminado de Linux
                //    exec("xdg-open \"$spreadsheetLink\"");
                //} else {
                    // Maneja otros sistemas operativos aquí (por ejemplo, Windows)
                    // Puedes usar shell_exec u otros comandos según corresponda
                    // Por ejemplo, en Windows podrías usar "start" para abrir el enlace
                //    shell_exec("start $spreadsheetLink");
                //}
                echo "La hoja de cálculo se ha creado. Puedes acceder a ella en: " . $spreadsheetLink;
            }             
        }
        #dd($body,$datos['body'],$folios);
    
    }*/
    
    public function segval ($folio){
        $estatus = registro::select('id_estatus')->where('folio',$folio)->first();
        $levantamiento = levantamiento::FindOrFail($folio);
        switch($estatus->id_estatus){
            case 9: 
                $levantamiento->fecha_def = now(); 
                $levantamiento->save();
            case 7:
                $levantamiento->fechades = now(); 
                $levantamiento->save();
            break;
            case 2:
                $update = liberacion::FindOrFail($folio);
                $update->evidencia_p = true; 
                $update->save();
            break;
        }
        return redirect(route('Documentos',Crypt::encrypt($folio)));
        #return ($update);
    }

    /*function store(Request $data,$folio){ 
        $validFileNames = [
            'matriz de pruebas',
            'acta de validación',
            'acta de cierre',
            'definición de requerimiento',
            'flujo de trabajo',
            'mockup',
            'plan de trabajo'
        ];
        $estatus = registro::where('folio',$folio)->first();
        $aut_def = levantamiento::where('folio',$folio)->first(); 
        $definicion = archivo::where([['folio',$folio],['url','like','%Definición de requerimiento%']])->first();
        $version = $definicion ? $definicion->version + 1 : 1;
        //$version = archivo::select('url')->where([['folio',$folio],['url','like','%Definición de requerimiento%']])->count();
        $plan = archivo::where([['folio',$folio],['url','like','%Flujo de trabajo%']])->first();
        $matriz = archivo::where([['folio',$folio],['url','like','%matriz de pruebas%']])->first();
        $files = null;
        if ($data->hasFile('adjunto')) {
            $rename = mb_strtolower($data->file('adjunto')->getClientOriginalName());
            foreach ($validFileNames as $validName) {
                if (stristr($rename, $validName)) {
                    break; // Salir del bucle al encontrar una coincidencia
                }else{
                    $rename=null;
                }
            }
            if (empty($rename)) {
                if ($estatus->id_estatus == 8) {
                    if($matriz){
                        $rename = $folio.' Acta de validación';
                    }else{
                        $rename = $folio.' Matriz de pruebas';
                    }
                } else if ($estatus->id_estatus == 2) {
                    $rename = $folio.' Acta de cierre';
                } else if (($estatus->id_estatus == 11) || ($estatus->id_estatus == 9 && $plan && $aut_def->fecha_def==NULL)) {
                    $rename = $folio.' Definición de requerimiento';//,'flujo de trabajo', 'mockup'];
                }else if ($estatus->id_estatus == 9 && $plan==NULL && $aut_def->fecha_def==NULL) {
                    $rename = $folio.' Flujo de trabajo';
                }else if ($estatus->id_estatus == 9 && $plan && $aut_def->fecha_def) {
                    $rename = $folio.' Plan de trabajo';
                }else if ($estatus->id_estatus == 10 || $estatus->id_estatus == 16) {
                    $rename = $folio.' Gantt';
                }
            }
            if($version && $rename ==  $folio.' Definición de requerimiento'){
                $orginalPath = "public/storage/$folio/". $rename . '.' . $data->file('adjunto')->getClientOriginalExtension();
                $newFileName = $folio . ' Definición de requerimiento'." versión ".$version;
                $newFilePath = "public/storage/$folio/extra/$newFileName.". $data->file('adjunto')->getClientOriginalExtension();
                Storage::move($orginalPath, $newFilePath);
                $definicion->update(['url' => $newFilePath]);
            }
                $files = Storage::putFileAs("public/storage$folio", $data->file('adjunto'), $rename . '.' . $data->file('adjunto')->getClientOriginalExtension());
                archivo::create(['folio' => $folio, 'url' => "public/$folio/$rename"]);
            
        }else{
            $rename = mb_strtolower($data->file('General')->getClientOriginalName());
            $files = Storage::putFileAs("public/$folio", $data->file('General'),$rename);
            archivo::create(['folio' => $folio, 'url' => "public/storage/$folio/$rename"]);
        }
    }*/

    function store(Request $data, $folio)
    {
        $validFileNames = [
            'matriz de pruebas',
            'acta de validación',
            'acta de cierre',
            'definición de requerimiento',
            'flujo de trabajo',
            'mockup',
            'plan de trabajo'
        ];

        $estatus = registro::where('folio', $folio)->first();
        $aut_def = levantamiento::where('folio', $folio)->first();
        $definicion = archivo::where([
            ['folio', $folio],
            ['url', 'like', '%Definición de requerimiento%'],
            ['url', 'not like', '%versión%']
        ])->first();
        $version = archivo::where([
            ['folio', $folio],
            ['url', 'like', '%Definición de requerimiento%']])->count();
        $plan = archivo::where([
            ['folio', $folio],
            ['url', 'like', '%Flujo de trabajo%']
        ])->first();
        $matriz = archivo::where([
            ['folio', $folio],
            ['url', 'like', '%matriz de pruebas%']
        ])->first();

        if ($data->hasFile('adjunto')) {
            $rename = mb_strtolower($data->file('adjunto')->getClientOriginalName());

            foreach ($validFileNames as $validName) {
                if (stristr($rename, $validName)) {
                    break; // Salir del bucle al encontrar una coincidencia
                } else {
                    $rename = null;
                }
            }

            if (empty($rename)) {
                if ($estatus->id_estatus == 8) {
                    $rename = $matriz ? $folio . ' Acta de validación' : $folio . ' Matriz de pruebas';
                } elseif ($estatus->id_estatus == 2) {
                    $rename = $folio . ' Acta de cierre';
                } elseif (($estatus->id_estatus == 11) || ($estatus->id_estatus == 9 && $aut_def->fecha_def == NULL)) {
                    $rename = $folio . ' Definición de requerimiento';
                } elseif ($estatus->id_estatus == 9 && $aut_def->fecha_def) {
                    $rename = $folio . ' Plan de trabajo';
                } elseif ($estatus->id_estatus == 10 || $estatus->id_estatus == 16) {
                    $rename = $folio . ' Gantt';
                }
            }
            if ($version > 0 && $rename == $folio . ' Definición de requerimiento') {
                $originalName = pathinfo($definicion->url, PATHINFO_FILENAME);
                $orginalPath = "public/$folio/" . $originalName . '.' . $data->file('adjunto')->getClientOriginalExtension();
                $newFileName = $folio . ' Definición de requerimiento' . " versión " . $version;
                $newFilePath = "public/$folio/extra/$newFileName." . $data->file('adjunto')->getClientOriginalExtension();
                Storage::move($orginalPath, $newFilePath);
                $definicion->update(['url' => "/storage/$folio/extra/$newFileName." . $data->file('adjunto')->getClientOriginalExtension()]);
            }

            $files = Storage::putFileAs("public/$folio", $data->file('adjunto'), "$rename." . $data->file('adjunto')->getClientOriginalExtension());
            archivo::create(['folio' => $folio, 'url' => "/storage/$folio/$rename.". $data->file('adjunto')->getClientOriginalExtension()]);
        } elseif($data->hasFile('Complemento')) {
            $rename = $data->file('Complemento')->getClientOriginalName();
            $files = Storage::putFileAs("public/$folio/COMPLEMENTOS", $data->file('Complemento'), $rename);
            archivo::create(['folio' => $folio, 'url' => "/storage/$folio/COMPLEMENTOS/$rename"]);
        } else{
            $rename = $data->file('General')->getClientOriginalName();
            $files = Storage::putFileAs("public/$folio", $data->file('General'), $rename);
            archivo::create(['folio' => $folio, 'url' => "/storage/$folio/$rename"]);
        }
    }

    public function destroy($name,$folio){
        #$name = pathinfo($data->file, PATHINFO_FILENAME);
        $archivo = archivo::where('url', 'like', '%' . $name . '%')->where('folio', $folio)->first();
        
            $file = str_replace('storage',"public",$archivo->url);
            Storage::delete($file);
            $archivo->delete();
    }

}
