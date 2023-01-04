<?php

namespace App\Mail;

use App\Models\archivo;
use App\Models\responsable;
use App\Models\sistema;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use PDF;

class ValidacionCliente extends Mailable
{
    use Queueable, SerializesModels;

    public $formato;
    public $responsables;
    public $sistemas;
    public $involucrados;
    public $relaciones;
    public $subject;
    public $file;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($folio)
    {
        //
        $this->formato = db::table('registros as r')
                          ->select('r.folio',
                                    'r.descripcion',
                                    'l.created_at as fsol',
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
                                    'l.involucrados',
                                    'r.id_estatus as estatus')
                          ->leftjoin('levantamientos as l', 'r.folio', 'l.folio')
                          ->leftJoin('areas as a', 'r.id_area','a.id_area')
                          ->leftJoin('departamentos as d','l.departamento','d.id')
                          ->leftJoin('responsables as jd','l.jefe_departamento','jd.id_responsable')
                          ->leftJoin('sistemas as s','r.id_sistema', 's.id_sistema')
                          ->leftJoin('clientes as c','c.id_cliente','r.id_cliente')
                          ->leftJoin('responsables as au','l.autorizacion','au.id_responsable')
                          ->leftJoin('solicitantes as sol','sol.id_solicitante','l.id_solicitante')
                          ->where('l.folio', $folio)->get();
        $this->sistemas = sistema::all();
        $this->responsables = responsable::all();
        foreach($this->formato as $fold){
            $this->relaciones = explode(',',$fold->relaciones);
            $this->involucrados = explode(',',$fold->involucrados);
            $this->subject = "$fold->folio $fold->descripcion";
        }
        $this->file = archivo::where('folio',$folio)->get();
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->markdown('correos.contenido');
        // $archivosadjuntos es una matriz con rutas de archivos de archivos adjuntos
        foreach($this->file as $ruta){
            $email->attach(public_path($ruta->url));
        }
        return $email;
        #return $this->file;

        
    }
}
