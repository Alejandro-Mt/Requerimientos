<?php

namespace App\Http\Controllers;

use App\Models\clase;
use App\Models\estatu;
use App\Models\registro;
use App\Models\responsable;
use App\Models\sistema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

class RecordController extends Controller
{
    protected function index(){
        
        $clases = clase::all();
        $cliente = db::table('clientes')->orderby('id_cliente', 'asc')->get();
        $estatus = estatu::all();
        $id = registro::latest('id_registro')->first();
        $registros = registro::where('folio', 'like', 'PIP%')->count();
        $responsable = responsable::orderby('apellidos', 'asc')->get();
        $sistema = sistema::all();
        $vacio = registro:: select('*')->count();
        return view('formatos.requerimientos.new',compact('clases','cliente','estatus','id','registros','responsable','sistema','vacio'));
        #dd($registros);
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
        registro::create([
            'folio' => $folio,
            'descripcion' => $data['descripcion'],
            'id_responsable' => $data['id_responsable'],
            'id_sistema' => $data['id_sistema'],
            'id_cliente' => $data['id_cliente'],
            'id_estatus' => $data['id_estatus'],
            'id_area' => $data['id_area'],
            'id_arquitecto' => $data['id_arquitecto'],
            'id_clase' => $data['id_clase']
        ]);
        
    #dd($folio);
    return redirect(route('Nuevo'))->with('alert', $folio);
    
    }


}
