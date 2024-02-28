<?php

namespace App\Mail;

use App\Models\registro;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SegundaValidacion extends Mailable
{
    use Queueable, SerializesModels;

    public $dato;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($folio)
    {
        //
        $this->dato = registro::where('registros.folio',$folio)
                        ->leftjoin('levantamientos as l','l.folio','registros.folio')
                        ->leftjoin('clases as c','c.id_clase','registros.id_clase')
                        ->leftjoin('responsables as r','r.id_responsable','registros.id_responsable')
                        ->first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('correos.respuesta desarrollo.validar')->subject('Definición de impacto');
    }
}
