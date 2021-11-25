<?php

namespace App\Mail;

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

    public $subjet = "Confirmacion de Seguimiento";
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
                                    'l.solicitante',
                                    'd.departamento',
                                    'jd.nombre_r as j_dep',
                                    's.nombre_s',
                                    'c.nombre_cl',
                                    'au.nombre_r as autorizo',
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
                          ->where('l.folio', $folio)->get();
        $this->sistemas = sistema::all();
        $this->responsables = responsable::all();
        foreach($this->formato as $fold){
            $this->relaciones = explode(',',$fold->relaciones);
            $this->involucrados = explode(',',$fold->involucrados);
        }
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('correos.contenido');
    }
}
