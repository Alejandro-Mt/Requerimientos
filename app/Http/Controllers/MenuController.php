<?php

namespace App\Http\Controllers;

use App\Mail\ValidacionCliente;
use App\Models\analisis;
use App\Models\construccion;
use App\Models\estatu;
use App\Models\pausa;
use App\Models\planeacion;
use App\Models\registro;
use App\Models\subproceso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PHPUnit\TextUI\XmlConfiguration\Group;
use Symfony\Component\VarDumper\Cloner\Data;

class MenuController extends Controller
{
   
    /*public function create()
    {
        return view('formatos.requerimientos.new');
    }*/


    public function edit()
    {
        $subprocesos = subproceso::all();
        $registros = registro::select('*')->join('estatus','estatus.id_estatus', 'registros.id_estatus')->get();
        #$pausa = pausa::select('registros.folio','pausas.pausa')->rightjoin('registros','registros.folio', 'pausas.folio')->groupby('folio')->orderby('pausas.created_at','desc')->get();
        $pausa = pausa::select('r.folio',/*'pausas.pausa',*/pausa::raw('max(pausas.pausa) as pausa'))->rightjoin('registros as r','r.folio', 'pausas.folio')->groupby('r.folio')->get();
        foreach ($pausa as $p);# $p->folio;
        $vacio = pausa::count();
        return view('formatos.requerimientos.edit',compact('registros','subprocesos','pausa','vacio'));
        #dd($pausa);
    }

    public function pause($folio){
        pausa::create([
            'folio'=> $folio,
            'pausa'=> '1'   
        ]);
        return redirect(route('Editar'));
    }
    public function play($folio){
        $reaunudar = pausa::select('*')-> where ('folio', $folio)->orderby('created_at','desc')->first();
        $reaunudar->pausa = '0';
        $reaunudar->save();  
        return redirect(route('Editar'));
        #dd($registros->all());
    }

    public function send($folio){
        $registros = registro::select('*')-> where ('folio', $folio)->get();
        return view('Layouts.correo',compact('registros'));
        #dd($registros);
    }
    public function sended(request $data){
        mail::to($data->email)->send(new ValidacionCliente);
        $estatus = registro::select("*")-> where ('folio', $data->folio)->first();
        $estatus->id_estatus = $data->input('id_estatus');
        $estatus->save();
        return redirect('formatos.requerimientos.edit');
        #dd($estatus);
    }
    public function subproceso($folio){
        $registros = registro::select('*')-> where ('folio', $folio)->get();
        $subprocesos = subproceso::latest('subproceso')-> where ('folio', $folio)->limit(1)->get();
        $vacio = subproceso:: select('*')->where ('folio', $folio)->count();
        return view('formatos.subproceso',compact('registros','vacio'));
        #dd($folio);
    }
    public function sub(request $data){
        subproceso::create([
            'folio'=>$data['folio'],
            'subproceso'=>$data['subproceso'],
            'previsto'=>date("y/m/d", strtotime($data['previsto'])),
            'estatus' =>$data['estatus']
        ]);
        #$registros = registro::select('*')-> where ('folio', $data->folio)->first();
        #$registros->id_estatus = $data->input('id_estatus');
        #$registros->save();  
        return redirect(route('Editar'));
        #dd($registros->all());
    }

    public function close($folioS){
        $concluir = subproceso::select('*')-> where ('subproceso', $folioS)->first();
        $concluir->estatus = 'Concluido';
        $concluir->save();
        return redirect(route('Editar'));
        #dd($concluir);
    }
}
