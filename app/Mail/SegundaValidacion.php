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

    public $datos;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($folio)
    {
        //
        $this->datos = registro::where('registros.folio',$folio)
                        ->leftjoin('levantamientos as l','registros.folio','l.folio')
                        ->get();
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
