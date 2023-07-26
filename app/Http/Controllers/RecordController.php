<?php

namespace App\Http\Controllers;

use App\Mail\Cliente\Fase;
use App\Mail\Interno\NuevoProyecto;
use App\Models\clase;
use App\Models\estatu;
use App\Models\levantamiento;
use App\Models\registro;
use App\Models\responsable;
use App\Models\sistema;
use App\Models\solicitud;
use App\Models\solpri;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class RecordController extends Controller
{
    protected function index(){
        
        $clases = clase::all();
        $cliente = db::table('clientes')->orderby('id_cliente', 'asc')->get();
        $datos = null;
        $proyectos = registro::where('folio', 'like', 'PR-PIP%')->get();
        #$id = registro::latest('id_registro')->first();
        $registros = registro::where('folio', 'like', 'PIP%')->count();
        $responsable = responsable::orderby('apellidos', 'asc')->get();
        $sistema = sistema::all();
        $vacio = registro:: select('*')->count();
        return view('formatos.requerimientos.new',compact('clases','cliente','datos','proyectos','registros','responsable','sistema','vacio'));
        dd($proyectos);
    }

    /*public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'descripcion' => ['required', 'string', 'max:255'],
            'id_responsable' => ['required', 'string', 'max:255'],
            'id_sistema' => ['required', 'string', 'max:255'],
            'id_cliente' => ['required', 'string', 'max:255'],
        ]);
    }*/

    protected function create(request $data){
        $y = new DateTime('NOW');
        $y = $y->format('y');
        if ($data['es_pr'] == 1){
            $registros = registro::where('folio', 'like', "PR-PIP%-$y")->count();
            $registros = $registros + 1;
            if($registros<10){
                $folio = "PR-PIP-00$registros-$y";
            }
            else{
                if($registros<100){
                    $folio = "PR-PIP-0$registros-$y";
                }
                else{
                    $folio = "PR-PIP-$registros-$y";
                }
            }
            $destino = 
                db::
                    table('users as u')->
                    where('u.id_puesto','>',5)->get();
            foreach($destino as $correo){ 
                mail::to($correo->email)->send(new NuevoProyecto($data,$correo->nombre));
            } 
        }
        else{
            $registros = registro::where('folio', 'like', "PIP%-$y")->count();
            $registros = $registros + 1;
            if($registros<10){
                $folio = "PIP-00$registros-$y";
            }
            else{
                if($registros<100){
                    $folio = "PIP-0$registros-$y";
                }
                else{
                    $folio = "PIP-$registros-$y";
                }
            }
        }
        registro::create([
            'folio' => $folio,
            'descripcion' => $data['descripcion'],
            'id_responsable' => $data['id_responsable'],
            'id_sistema' => $data['id_sistema'],
            'id_cliente' => $data['id_cliente'],
            'id_estatus' => 17,
            'id_area' => 6,
            'id_arquitecto' => $data['id_arquitecto'],
            'id_clase' => $data['id_clase'],
            'es_proyecto' => $data['es_pr'],
            'folio_pr' => $data['folio_pr'],
            'es_emergente' => $data['es_em']
        ]);
        if($data['preregistro'] != NULL){
            $update = solicitud::where('folio',$data['preregistro'])->first();
            $update->id_estatus= '21';
            $update->folior = $folio;
            $update->save();
        }
        $listado = solpri::where([['estatus', 'autorizado'],['id_cliente',$data['id_cliente']]])->orderby('id','desc')->first();
        if(($listado) != NULL){
            $listado->orden = $listado->orden.','.$folio;
            $listado->save();
        }
        #dd(($folio));
        return redirect(route('Nuevo'))->with('alert', $folio);
    }
    
    public function update($folio)
    {
        $registro = registro::where('folio',$folio)->first();
        $registro->id_estatus= 14;
        $registro->save();
        $email = levantamiento::join('solicitantes as s', 's.id_solicitante', '=', 'levantamientos.id_solicitante')
            ->where('folio', $folio)
            ->select('s.email')
            ->first();
        $gerencia = User::
            join('puestos as p','p.id_puesto','users.id_puesto')
            ->where('id_area', 6)
            ->whereIn('jerarquia',[4,5])
            ->select('email')
            ->get();
        if($email){
            Mail::to($email->email)->cc($gerencia->pluck('email'))->send(new Fase($folio,'14'));
        }
        return redirect(route('Documentos',Crypt::encrypt($folio)));
    }

}