<?php

namespace App\Http\Controllers;

use App\Mail\Interno\ActualizacionPrioridades;
use App\Mail\Interno\PrioridadCliente;
use App\Models\acceso;
use App\Models\archivo;
use App\Models\Cliente;
use App\Models\comentario;
use App\Models\desfase;
use App\Models\estatu;
use App\Models\levantamiento;
use App\Models\pausa;
use App\Models\planeacion;
use App\Models\pricli;
use App\Models\registro;
use App\Models\sistema;
use App\Models\solicitud;
use App\Models\solpri;
use Carbon\Carbon;
use Facade\FlareClient\Http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $rename = $data->nombre_cl.'.'.pathinfo($data->file('logo')->getClientOriginalName(), PATHINFO_EXTENSION);
        $data->validate(['logo'=>'required']);{
            $file = Storage::putFileAs("public/clientes", $data->file('logo'),$rename);
            $url = Storage::url($file);
        }
        Cliente::create([
            'nombre_cl' => $data['nombre_cl'],
            'abreviacion' => $data['abreviacion'],
            'logo' => $url,
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
        $archivos = archivo::where('folio',$folio)->get();
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
          ->where('folio',$folio)->get();
        $desfases = desfase::all();
        $estatus = estatu::orderby('posicion','asc')->get();
        $formatos = levantamiento::where('folio',$folio)->count();
        $pausa = pausa::select('r.folio',pausa::raw('ifnull(max(pausas.pausa),0) as pausa'),'d.motivo')
          ->rightjoin('registros as r','r.folio', 'pausas.folio')
          ->leftjoin('desfases as d','d.id', 'pausas.id_motivo')
          ->where('r.folio',$folio)
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
            where('registros.folio',$folio)->
            first();
        $reg = planeacion::where('folio',$folio)->exists();
        if($reg){$link = planeacion::select('evidencia')->where('folio',$folio)->first();}else{$link = NULL;}
        return view('cliente.documentacion',compact('archivos','comentarios','desfases','estatus','folio','formatos','link','pausa','registros'));
        #dd($formatos);
    }

    public function priority($id)
    {
        //
        $orden = solpri::where([['estatus', 'autorizado'],['id_cliente',$id]])->orderby('id','desc')->limit(1)->get();
        $validar = solpri::where([['estatus', 'autorizado'],['id_cliente',$id]])->count();
        $clientes = 
            registro::
                select('cl.id_cliente','cl.nombre_cl')->
                join('clientes as cl', 'registros.id_cliente','cl.id_cliente')->
                where('registros.id_sistema',$id)->
                wherein('registros.id_sistema',acceso::select('id_sistema')->where('id_user',Auth::user()->id))->
                orderby('cl.nombre_cl')->
                distinct()->
                get();
        $pendientes = 
            registro::
                join('clientes as cl','cl.id_cliente','registros.id_cliente')
                ->join('estatus as e','e.id_estatus','registros.id_estatus')
                ->wherenotin('registros.id_estatus',[13,14,18])
                ->wherenotin('folio',pausa::select('folio')->where('pausa',2)->distinct())
                ->where('registros.id_sistema', $id)
                ->wherein('registros.id_sistema',acceso::select('id_sistema')->where('id_user',Auth::user()->id))
                ->get();
        $implementados = 
            registro::
                join('clientes as cl','cl.id_cliente','registros.id_cliente')
                ->where('registros.id_estatus','18')
                ->where('registros.id_sistema', $id)
                ->wherein('registros.id_sistema',acceso::select('id_sistema')->where('id_user',Auth::user()->id))
                ->get();
        $pospuestos = 
            registro::
                join('clientes as cl','cl.id_cliente','registros.id_cliente')
                ->wherein(
                    'folio',
                    pausa::select('folio')
                    ->where('pausa',2)
                    ->where('registros.id_sistema', $id)
                    ->distinct()
                )
                ->orwhere('registros.id_estatus',13)
                ->where('registros.id_sistema', $id)
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
        //dd($validar);
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
        $destino = 
            db::
                table('users as u')->
                select('email')->
                join('accesos as a','u.id','a.id_user')->
                where([['a.id_sistema','=',$data['id_sistema']],['u.id_puesto','>',3]])->get();
        foreach($destino as $correo){  
            mail::to($correo->email)->send(new ActualizacionPrioridades($data)); 
        } 
        #return redirect(route('Prioridad',$data['id_cliente']));
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
        //dd($validar);
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
        $destino = 
            db::
            table('users as u')->
            select('email')->
            join('accesos as a','u.id','a.id_user')->
            where([['a.id_sistema','=',$data['id_sistema']],['u.id_puesto','=',3]])->
            get();
        foreach($destino as $correo){  
            mail::to($correo->email)->send(new PrioridadCliente($data)); 
        } 
        dd($data);

    }

}